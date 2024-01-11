<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_user', 'user');
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxUser()
    {
        $this->load->model("datatable/S_user_model", "SUmodel");
        $resuls = $this->SUmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            if ($result->prodi) {
                $prodi = $this->prodi->getDataByKode($result->prodi)->namaprodi;
            } else {
                $prodi = '-';
            }

            if ($result->level == 'SA') {
                $level = "Super Admin";
            } elseif ($result->level == 'AP') {
                $level = "Admin Prodi";
            }


            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/admin/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-primary btn-flat" onclick="bukaModalPassword(' . "'" . $result->id . "'" . ')"><i class="fa fa-lock"></i></button>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->username . '</div>';
            $row[] =  '<div class="">' . $level . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . ucwords($result->status) . '</div>';
            $row[] =  '<div class="">' . $result->nama . '</div>';
            $row[] =  '<div class="">' . $result->jk . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SUmodel->count_all_data(),
            "recordsFiltered" => $this->SUmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getuserbyid($id)
    {
        $user = $this->user->getDataById($id);

        $data = [
            "id" => $user->id,
            "username" => $user->username,
            "password" => $user->password,
            "level" => $user->level,
            "prodi" => $user->prodi,
            "jk" => $user->jk,
            "status" => $user->status,
            "nama" => $user->nama,
            "foto" => $user->foto,
            "create" => $user->create,
            "update" => $user->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';
        $konfirmasi_password_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('jk', 'zzz', 'trim|required', ["required" => "Jenis Kelamin Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('level', 'zzz', 'trim|required', ["required" => "Level Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('username', 'zzz', 'trim|required', ["required" => "Username Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('password', 'zzz', 'trim|required', ["required" => "Password Tidak Boleh Kosong!"]);
        if ($this->input->post('level', true) == 'AP') {
            $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        }
        if ($this->input->post('password', true)) {
            $this->form_validation->set_rules('konfirmasi_password', 'zzz', 'trim|required', ["required" => "Konfirmasi Password Tidak Boleh Kosong!"]);
        }

        if ($this->form_validation->run() == FALSE) {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            } else {
                $foto_error = '';
            }

            $konfirmasi_password_error = form_error("konfirmasi_password");
            if ($this->input->post('password', true)) {
                if ($this->input->post('konfirmasi_password', true)) {
                    if ($this->input->post('password', true) == $this->input->post('konfirmasi_password', true)) {
                        $konfirmasi_password_error = "";
                    } else {
                        $konfirmasi_password_error = "Password Tidak Cocok";
                    }
                }
            }
        } else {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            } else {
                $foto_error = '';
            }

            $konfirmasi_password_error = form_error("konfirmasi_password");
            if ($this->input->post('password', true)) {
                if ($this->input->post('konfirmasi_password', true)) {
                    if ($this->input->post('password', true) == $this->input->post('konfirmasi_password', true)) {
                        $konfirmasi_password_error = "";
                    } else {
                        $konfirmasi_password_error = "Password Tidak Cocok";
                    }
                }
            }

            if ($foto_error == '' and $konfirmasi_password_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/user/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->input->post('level', true) == 'AP') {
                    $prodi = $this->input->post('kodeprodi', true);
                } else {
                    $prodi = null;
                }

                $dataUser = [
                    // "id"
                    "username" => $this->input->post('username', true),
                    "password" => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
                    "level" => $this->input->post('level', true),
                    "prodi" => $prodi,
                    "jk" => $this->input->post('jk', true),
                    // "status",
                    "nama" => $this->input->post('nama', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("user", $dataUser);
                if ($query) {
                    if ($this->upload->do_upload('foto')) {
                        $this->upload->data('file_name');
                    }
                }

                $this->db->trans_complete(); # Completing transaction

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    $message = "sukses";
                }
                // END TRANSACTION
            }
        }

        $data = [
            "nama_error" => form_error("nama"),
            "jk_error" => form_error("jk"),
            "level_error" => form_error("level"),
            "username_error" => form_error("username"),
            "password_error" => form_error("password"),
            "kodeprodi_error" => form_error("kodeprodi"),
            "konfirmasi_password_error" => $konfirmasi_password_error,
            "foto_error" => $foto_error,
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function hapusDataProcess()
    {
        $message = 'gagal';

        // START TRANSACTION
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

        $user = $this->user->getDataById($this->input->post('id', true));

        if ($user->foto) {
            unlink(FCPATH . "/assets/gambarDB/user/" . $user->foto);
        }

        $this->db->delete('user', ['id' => $user->id]);

        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $message = "sukses";
        }
        // END TRANSACTION

        $data = [
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function editDataProcess()
    {
        $message = 'gagal';

        // konfigurasi form validasi
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('jk', 'zzz', 'trim|required', ["required" => "Jenis Kelamin Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('level', 'zzz', 'trim|required', ["required" => "Level Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('username', 'zzz', 'trim|required', ["required" => "Username Tidak Boleh Kosong!"]);
        if ($this->input->post('level', true) == 'AP') {
            $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        }

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $user = $this->user->getDataById($this->input->post('id', true));
            $fileName = $user->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/user/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($user->foto) {
                    unlink(FCPATH . "/assets/gambarDB/user/" . $user->foto);
                }
            }

            if ($this->input->post('level', true) == 'AP') {
                $prodi = $this->input->post('kodeprodi', true);
            } else {
                $prodi = null;
            }

            $dataUser = [
                // "id"
                "username" => $this->input->post('username', true),
                // "password",
                "level" => $this->input->post('level', true),
                "prodi" => $prodi,
                "jk" => $this->input->post('jk', true),
                "status" => $this->input->post('status', true),
                "nama" => $this->input->post('nama', true),
                "foto" => $fileName,
                // "create",
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("user", $dataUser, ['id' => $this->input->post('id', true)]);
            // khusus dirinya sendiri -> update session
            if ($this->input->post('id', true) == $this->session->userdata('id_user')) {
                $sesi = ['username_user', 'level_user', 'prodi_user', 'jk_user', 'status_user', 'nama_user', 'foto_user'];
                $this->session->unset_userdata($sesi);
                $sesi = [
                    'username_user' => $this->input->post('username', true),
                    'level_user' => $this->input->post('level', true),
                    'prodi_user' => $prodi,
                    'jk_user' => $this->input->post('jk', true),
                    'status_user' => $this->input->post('status', true),
                    'nama_user' => $this->input->post('nama', true),
                    'foto_user' => $fileName,
                ];
                $this->session->set_userdata($sesi);
            }
            if ($query and $_FILES['foto']['size'] != 0) {
                if ($this->upload->do_upload('foto')) {
                    $this->upload->data('file_name');
                }
            }


            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $message = "sukses";
            }
            // END TRANSACTION
        }

        $data = [
            "kodeprodi_error" => form_error("kodeprodi"),
            "judul_error" => form_error("judul"),
            "content_error" => form_error("content"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function gantiPasswordProcess()
    {
        $message = 'gagal';
        $konfirmasi_password_pass_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('password_pass', 'zzz', 'trim|required', ["required" => "Password Tidak Boleh Kosong!"]);
        if ($this->input->post('password_pass', true)) {
            $this->form_validation->set_rules('konfirmasi_password_pass', 'zzz', 'trim|required', ["required" => "Konfirmasi Password Tidak Boleh Kosong!"]);
        }

        if ($this->form_validation->run() == FALSE) {
            $konfirmasi_password_pass_error = form_error("konfirmasi_password_pass");
            if ($this->input->post('password_pass', true)) {
                if ($this->input->post('konfirmasi_password_pass', true)) {
                    if ($this->input->post('password_pass', true) == $this->input->post('konfirmasi_password_pass', true)) {
                        $konfirmasi_password_pass_error = "";
                    } else {
                        $konfirmasi_password_pass_error = "Password Tidak Cocok";
                    }
                }
            }
        } else {
            $konfirmasi_password_pass_error = form_error("konfirmasi_password_pass");
            if ($this->input->post('password_pass', true)) {
                if ($this->input->post('konfirmasi_password_pass', true)) {
                    if ($this->input->post('password_pass', true) == $this->input->post('konfirmasi_password_pass', true)) {
                        $konfirmasi_password_pass_error = "";
                    } else {
                        $konfirmasi_password_pass_error = "Password Tidak Cocok";
                    }
                }
            }

            if ($konfirmasi_password_pass_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                $dataUser = [
                    // "id"
                    // "username",
                    "password" => password_hash($this->input->post('password_pass', true), PASSWORD_DEFAULT),
                    // "level",
                    // "prodi",
                    // "jk",
                    // "status",
                    // "nama",
                    // "foto"
                    // "create",
                    "update" => date("Y-m-d H:i:s"),
                ];

                $this->db->update("user", $dataUser, ['id' => $this->input->post('id_pass', true)]);
                // khusus dirinya sendiri -> update session
                if ($this->input->post('id_pass', true) == $this->session->userdata('id_user')) {
                    $sesi = ['password_user'];
                    $this->session->unset_userdata($sesi);
                    $sesi = [
                        'password_user' => password_hash($this->input->post('password_pass', true), PASSWORD_DEFAULT),
                    ];
                    $this->session->set_userdata($sesi);
                }


                $this->db->trans_complete(); # Completing transaction

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    $message = "sukses";
                }
                // END TRANSACTION
            }
        }

        $data = [
            "password_pass_error" => form_error("password_pass"),
            "konfirmasi_password_pass_error" => $konfirmasi_password_pass_error,
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
