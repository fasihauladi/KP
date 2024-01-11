<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katpengabdian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_katpengabdian', 'katpengabdian');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxMacamPengabdian()
    {
        $this->load->model("datatable/S_macam_pengabdian_model", "SMPmodel");
        $resuls = $this->SMPmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $tombolAksi = '
                <a href="' . base_url() . 'superadmin/macam-pengabdian/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->kategori . '</div>';
            $row[] =  '<div class="">' . $result->subkategori . '</div>';
            $row[] =  '<div class="">' . $result->deskripsi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SMPmodel->count_all_data(),
            "recordsFiltered" => $this->SMPmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getkatpengabdianbyid($id)
    {
        $katpengabdian = $this->katpengabdian->getDataById($id);

        $data = [
            "id" => $katpengabdian->id,
            "kategori" => $katpengabdian->kategori,
            "subkategori" => $katpengabdian->subkategori,
            "deskripsi" => $katpengabdian->deskripsi,
            "create" => $katpengabdian->create,
            "update" => $katpengabdian->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kategori', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('subkategori', 'zzz', 'trim|required', ["required" => "Sub Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataKategoriPengabdian = [
                // id
                "kategori" => $this->input->post('kategori', true),
                "subkategori" => $this->input->post('subkategori', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                "create" => date("Y-m-d H:i:s"),
                // "update"
            ];

            $this->db->insert("katpengabdian", $dataKategoriPengabdian);

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
            "kategori_error" => form_error("kategori"),
            "subkategori_error" => form_error("subkategori"),
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

        $this->db->delete('katpengabdian', ['id' => $this->input->post('id', true)]);

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
        $this->form_validation->set_rules('kategori', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('subkategori', 'zzz', 'trim|required', ["required" => "Sub Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataKategoriPengabdian = [
                // id
                "kategori" => $this->input->post('kategori', true),
                "subkategori" => $this->input->post('subkategori', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $this->db->update("katpengabdian", $dataKategoriPengabdian, ['id' => $this->input->post('id', true)]);

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
            "kategori_error" => form_error("kategori"),
            "subkategori_error" => form_error("subkategori"),
            "deskripsi_error" => form_error("deskripsi"),
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
