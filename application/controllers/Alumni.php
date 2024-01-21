<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alumni extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_alumni', 'alumni');
        $this->load->model('M_mahasiswa', 'mahasiswa');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxAlumni()
    {
        $this->load->model("datatable/S_alumni_model", "SAmodel");
        $resuls = $this->SAmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $mahasiswa = $this->mahasiswa->getDataByNpm($result->npm);

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="https://wa.me/' . $result->telp . '?text="" target="_blank"><button class="btn btn-xs btn-success btn-flat"><i class="fa fa-whatsapp"></i></button></a>
                <a href="' . base_url() . 'superadmin/data-alumni/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];

            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $mahasiswa->nama . ' (' . $mahasiswa->npm . ')' . '</div>';
            $row[] =  '<div class="">' . $result->telp . '</div>';
            $row[] =  '<div class="">' . $result->kesan . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SAmodel->count_all_data(),
            "recordsFiltered" => $this->SAmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getalumnibyid($id)
    {
        $alumni = $this->alumni->getDataById($id);
        if ($alumni) {
            $mahasiswa = $this->mahasiswa->getDataByNpm($alumni->npm);
            $namaMahasiswa = $mahasiswa->nama;
        } else {
            $namaMahasiswa = '-';
        }

        $data = [
            "id" => $alumni->id,
            "npm" => $alumni->npm,
            "kesan" => $alumni->kesan,
            "telp" => $alumni->telp,
            "foto" => $alumni->foto,
            "create" => $alumni->create,
            "update" => $alumni->update,
            "namaMahasiswa" => $namaMahasiswa,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('npm', 'zzz', 'trim|required', ["required" => "NIM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('telp', 'zzz', 'trim|required', ["required" => "WhatsApp Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kesan', 'zzz', 'trim|required', ["required" => "Kesan Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            }
        } else {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            }
            if ($foto_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/alumni';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataAlumni = [
                    // id
                    "npm" => $this->input->post('npm', true),
                    "kesan" => $this->input->post('kesan', true),
                    "telp" => $this->input->post('telp', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("alumni", $dataAlumni);
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
            "npm_error" => form_error("npm"),
            "telp_error" => form_error("telp"),
            "kesan_error" => form_error("kesan"),
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

        $alumni = $this->alumni->getDataById($this->input->post('id', true));

        if ($alumni->foto) {
            unlink(FCPATH . "/assets/gambarDB/alumni/" . $alumni->foto);
        }

        $this->db->delete('alumni', ['id' => $alumni->id]);

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
        $this->form_validation->set_rules('npm', 'zzz', 'trim|required', ["required" => "NIM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('telp', 'zzz', 'trim|required', ["required" => "WhatsApp Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kesan', 'zzz', 'trim|required', ["required" => "Kesan Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $alumni = $this->alumni->getDataById($this->input->post('id', true));
            $fileName = $alumni->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/alumni/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($alumni->foto) {
                    unlink(FCPATH . "/assets/gambarDB/alumni/" . $alumni->foto);
                }
            }

            $dataAlumni = [
                // id
                "npm" => $this->input->post('npm', true),
                "kesan" => $this->input->post('kesan', true),
                "telp" => $this->input->post('telp', true),
                "foto" => $fileName,
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("alumni", $dataAlumni, ['id' => $this->input->post('id', true)]);

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
            "npm_error" => form_error("npm"),
            "telp_error" => form_error("telp"),
            "kesan_error" => form_error("kesan"),
            // "foto_error" => $foto_error,
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
