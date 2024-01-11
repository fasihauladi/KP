<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_mahasiswa', 'mahasiswa');
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxMahasiswa()
    {
        $this->load->model("datatable/S_mahasiswa_model", "SMmodel");
        $resuls = $this->SMmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $tombolAksi = '
                <a href="' . base_url() . 'superadmin/mahasiswa/edit/' . $result->npm . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-primary btn-flat" onclick="bukaModalPassword(' . "'" . $result->npm . "'" . ')"><i class="fa fa-lock"></i></button>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->npm . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->npm . '</div>';
            $row[] =  '<div class="">' . $result->nama . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $result->angkatan . '</div>';
            $row[] =  '<div class="">' . $result->alamat . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SMmodel->count_all_data(),
            "recordsFiltered" => $this->SMmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getmahasiswabynpm($npm)
    {
        $mahasiswa = $this->mahasiswa->getDataByNpm($npm);

        $data = [
            "npm" => $mahasiswa->npm,
            "kodeprodi" => $mahasiswa->kodeprodi,
            "password" => $mahasiswa->password,
            "nama" => $mahasiswa->nama,
            "alamat" => $mahasiswa->alamat,
            "angkatan" => $mahasiswa->angkatan,
            "create" => $mahasiswa->create,
            "update" => $mahasiswa->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $npm_error = '';
        $konfirmasi_password_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('npm', 'zzz', 'trim|required', ["required" => "NPM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('angkatan', 'zzz', 'trim|required', ["required" => "Angkatan Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('alamat', 'zzz', 'trim|required', ["required" => "Alamat Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('password', 'zzz', 'trim|required', ["required" => "Password Tidak Boleh Kosong!"]);
        if ($this->input->post('password', true)) {
            $this->form_validation->set_rules('konfirmasi_password', 'zzz', 'trim|required', ["required" => "Konfirmasi Password Tidak Boleh Kosong!"]);
        }

        if ($this->form_validation->run() == FALSE) {
            $npm_error = form_error("npm");
            if ($this->input->post('npm', true)) {
                $cekNpm = $this->mahasiswa->getDataByNpm($this->input->post('npm', true));
                if ($cekNpm) {
                    $npm_error = '<p>NPM sudah ada (Tidak Boleh Sama)</p>';
                }
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
            $npm_error = form_error("npm");
            if ($this->input->post('npm', true)) {
                $cekNpm = $this->mahasiswa->getDataByNpm($this->input->post('npm', true));
                if ($cekNpm) {
                    $npm_error = '<p>NPM sudah ada (Tidak Boleh Sama)</p>';
                }
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

            if ($npm_error == '' and $konfirmasi_password_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                $dataMahasiswa = [
                    "npm" => $this->input->post('npm', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "password" => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
                    "nama" => $this->input->post('nama', true),
                    "alamat" => $this->input->post('alamat', true),
                    "angkatan" => $this->input->post('angkatan', true),
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $this->db->insert("mahasiswa", $dataMahasiswa);

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
            "npm_error" => $npm_error,
            "kodeprodi_error" => form_error("kodeprodi"),
            "nama_error" => form_error("nama"),
            "angkatan_error" => form_error("angkatan"),
            "alamat_error" => form_error("alamat"),
            "password_error" => form_error("password"),
            "konfirmasi_password_error" => $konfirmasi_password_error,
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

        $this->db->delete('mahasiswa', ['npm' => $this->input->post('npm', true)]);

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
        $npm_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('npm', 'zzz', 'trim|required', ["required" => "NPM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('angkatan', 'zzz', 'trim|required', ["required" => "Angkatan Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('alamat', 'zzz', 'trim|required', ["required" => "Alamat Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            $npm_error = form_error("npm");
            if ($this->input->post('npm', true)) {
                $cekNpm = $this->mahasiswa->getDataByNpm($this->input->post('npm', true));
                if ($cekNpm and $cekNpm->npm != $this->input->post('npm_awal', true)) {
                    $npm_error = '<p>NPM sudah ada (Tidak Boleh Sama)</p>';
                }
            }
        } else {
            $npm_error = form_error("npm");
            if ($this->input->post('npm', true)) {
                $cekNpm = $this->mahasiswa->getDataByNpm($this->input->post('npm', true));
                if ($cekNpm and $cekNpm->npm != $this->input->post('npm_awal', true)) {
                    $npm_error = '<p>NPM sudah ada (Tidak Boleh Sama)</p>';
                }
            }

            if ($npm_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                $dataMahasiswa = [
                    "npm" => $this->input->post('npm', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    // "password",
                    "nama" => $this->input->post('nama', true),
                    "alamat" => $this->input->post('alamat', true),
                    "angkatan" => $this->input->post('angkatan', true),
                    // "create"
                    "update" => date("Y-m-d H:i:s"),
                ];

                $this->db->update("mahasiswa", $dataMahasiswa, ['npm' => $this->input->post('npm_awal', true)]);

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
            "npm_error" => $npm_error,
            "kodeprodi_error" => form_error("kodeprodi"),
            "nama_error" => form_error("nama"),
            "angkatan_error" => form_error("angkatan"),
            "alamat_error" => form_error("alamat"),
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

                $dataMahasiswa = [
                    // "npm",
                    // "kodeprodi",
                    "password" => password_hash($this->input->post('password_pass', true), PASSWORD_DEFAULT),
                    // "nama",
                    // "alamat",
                    // "angkatan"
                    // "create"
                    "update" => date("Y-m-d H:i:s"),
                ];

                $this->db->update("mahasiswa", $dataMahasiswa, ['npm' => $this->input->post('npm_pass', true)]);

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
