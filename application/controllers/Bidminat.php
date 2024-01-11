<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidminat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_bidminat', 'bidminat');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxBidangMinat()
    {
        $this->load->model("datatable/S_bidang_minat_model", "SBMmodel");
        $resuls = $this->SBMmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;
            $prodi = $this->prodi->getDataByKode($result->kodeprodi);
            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalProfile(' . "'" . $result->id . "'" . ')">Profil</button>
                <button class="btn btn-xs btn-primary btn-flat" onclick="bukaModalPetaPenelitian(' . "'" . $result->id . "'" . ')">Peta</i></button>
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/bidang-minat/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $prodi->namaprodi . '</div>';
            $row[] =  '<div class="">' . $result->namabidminat . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SBMmodel->count_all_data(),
            "recordsFiltered" => $this->SBMmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getbidminatbyid($id)
    {
        $bidminat = $this->bidminat->getDataById($id);

        $data = [
            "id" => $bidminat->id,
            "kodeprodi" => $bidminat->kodeprodi,
            "namabidminat" => $bidminat->namabidminat,
            "profile" => $bidminat->profile,
            "petapenelitian" => $bidminat->petapenelitian,
            "foto" => $bidminat->foto,
            "create" => $bidminat->create,
            "update" => $bidminat->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Kode Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namabidminat', 'zzz', 'trim|required', ["required" => "Nama Bidang Minat Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('profile', 'zzz', 'trim|required', ["required" => "Profil Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('petapenelitian', 'zzz', 'trim|required', ["required" => "Peta Penelitian Tidak Boleh Kosong!"]);
        if ($this->form_validation->run() == FALSE) {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            } else {
                $foto_error = '';
            }
        } else {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            } else {
                $foto_error = '';
            }

            if ($foto_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/bidminat/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataBidangMinat = [
                    // "id"
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "namabidminat" => $this->input->post('namabidminat', true),
                    "profile" => $this->input->post('profile', true),
                    "petapenelitian" => $this->input->post('petapenelitian', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("bidminat", $dataBidangMinat);
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
            "kodeprodi_error" => form_error("kodeprodi"),
            "namabidminat_error" => form_error("namabidminat"),
            "foto_error" => $foto_error,
            "profile_error" => form_error("profile"),
            "petapenelitian_error" => form_error("petapenelitian"),
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

        $bidminat = $this->bidminat->getDataById($this->input->post('id', true));

        if ($bidminat->foto) {
            unlink(FCPATH . "/assets/gambarDB/bidminat/" . $bidminat->foto);
        }

        $this->db->delete('bidminat', ['id' => $this->input->post('id', true)]);

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
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Kode Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namabidminat', 'zzz', 'trim|required', ["required" => "Nama Bidang Minat Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('profile', 'zzz', 'trim|required', ["required" => "Profil Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('petapenelitian', 'zzz', 'trim|required', ["required" => "Peta Penelitian Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $bidminat = $this->bidminat->getDataById($this->input->post('id', true));
            $fileName = $bidminat->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/bidminat/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($bidminat->foto) {
                    unlink(FCPATH . "/assets/gambarDB/bidminat/" . $bidminat->foto);
                }
            }

            $dataBidangMinat = [
                // "id"
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "namabidminat" => $this->input->post('namabidminat', true),
                "profile" => $this->input->post('profile', true),
                "petapenelitian" => $this->input->post('petapenelitian', true),
                "foto" => $fileName,
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("bidminat", $dataBidangMinat, ['id' => $this->input->post('id', true)]);

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
            "namabidminat_error" => form_error("namabidminat"),
            // "foto_error" => $foto_error,
            "profile_error" => form_error("profile"),
            "petapenelitian_error" => form_error("petapenelitian"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
