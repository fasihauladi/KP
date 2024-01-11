<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katpenelitian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_katpenelitian', 'katpenelitian');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxKategoriPenelitian()
    {
        $this->load->model("datatable/S_kategori_penelitian_model", "SKPmodel");
        $resuls = $this->SKPmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $tombolAksi = '
                <a href="' . base_url() . 'superadmin/kategori-penelitian/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->namakatpen . '</div>';
            $row[] =  '<div class="">' . $result->namasubkatpen . '</div>';
            $row[] =  '<div class="">' . $result->deskripsi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SKPmodel->count_all_data(),
            "recordsFiltered" => $this->SKPmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getkatpenelitianbyid($id)
    {
        $katpenelitian = $this->katpenelitian->getDataById($id);

        $data = [
            "id" => $katpenelitian->id,
            "namakatpen" => $katpenelitian->namakatpen,
            "namasubkatpen" => $katpenelitian->namasubkatpen,
            "deskripsi" => $katpenelitian->deskripsi,
            "create" => $katpenelitian->create,
            "update" => $katpenelitian->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';

        // konfigurasi form validasi
        $this->form_validation->set_rules('namakatpen', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namasubkatpen', 'zzz', 'trim|required', ["required" => "Sub Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataKategoriPenelitian = [
                // id
                "namakatpen" => $this->input->post('namakatpen', true),
                "namasubkatpen" => $this->input->post('namasubkatpen', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                "create" => date("Y-m-d H:i:s"),
                // "update"
            ];

            $this->db->insert("katpenelitian", $dataKategoriPenelitian);

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
            "namakatpen_error" => form_error("namakatpen"),
            "namasubkatpen_error" => form_error("namasubkatpen"),
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

        $this->db->delete('katpenelitian', ['id' => $this->input->post('id', true)]);

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
        $this->form_validation->set_rules('namakatpen', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namasubkatpen', 'zzz', 'trim|required', ["required" => "Sub Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataKategoriPenelitian = [
                // id
                "namakatpen" => $this->input->post('namakatpen', true),
                "namasubkatpen" => $this->input->post('namasubkatpen', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $this->db->update("katpenelitian", $dataKategoriPenelitian, ['id' => $this->input->post('id', true)]);

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
            "namakatpen_error" => form_error("namakatpen"),
            "namasubkatpen_error" => form_error("namasubkatpen"),
            "deskripsi_error" => form_error("deskripsi"),
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
