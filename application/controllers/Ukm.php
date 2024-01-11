<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ukm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_ukm', 'ukm');
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxUKM()
    {
        $this->load->model("datatable/S_ukm_model", "SUmodel");
        $resuls = $this->SUmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/unit-kegiatan-mahasiswa/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];

            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->nama . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
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
    public function getukmbyid($id)
    {
        $ukm = $this->ukm->getDataById($id);

        $data = [
            "id" => $ukm->id,
            "kodeprodi" => $ukm->kodeprodi,
            "nama" => $ukm->nama,
            "deskripsi" => $ukm->deskripsi,
            "foto" => $ukm->foto,
            "create" => $ukm->create,
            "update" => $ukm->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama UKM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/ukm';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataUKM = [
                    // id
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "nama" => $this->input->post('nama', true),
                    "deskripsi" => $this->input->post('deskripsi', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("ukm", $dataUKM);
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
            "nama_error" => form_error("nama"),
            "foto_error" => $foto_error,
            "deskripsi_error" => form_error("deskripsi"),
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

        $ukm = $this->ukm->getDataById($this->input->post('id', true));

        if ($ukm->foto) {
            unlink(FCPATH . "/assets/gambarDB/ukm/" . $ukm->foto);
        }

        $this->db->delete('ukm', ['id' => $ukm->id]);

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
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama UKM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $ukm = $this->ukm->getDataById($this->input->post('id', true));
            $fileName = $ukm->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/ukm/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($ukm->foto) {
                    unlink(FCPATH . "/assets/gambarDB/ukm/" . $ukm->foto);
                }
            }

            $dataUKM = [
                // id
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "nama" => $this->input->post('nama', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                "foto" => $fileName,
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("ukm", $dataUKM, ['id' => $this->input->post('id', true)]);

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
            "nama_error" => form_error("nama"),
            // "foto_error" => $foto_error,
            "deskripsi_error" => form_error("deskripsi"),
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
