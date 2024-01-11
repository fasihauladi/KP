<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katlab extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_katlab', 'katlab');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxKategoriLaboratorium()
    {
        $this->load->model("datatable/S_kategori_laboratorium_model", "SKLmodel");
        $resuls = $this->SKLmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $tombolAksi = '
                <a href="' . base_url() . 'superadmin/kategori-laboratorium/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->kategori . '</div>';
            $row[] =  '<div class="">' . $result->keterangan . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SKLmodel->count_all_data(),
            "recordsFiltered" => $this->SKLmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getkatlabbyid($id)
    {
        $katlab = $this->katlab->getDataById($id);

        $data = [
            "id" => $katlab->id,
            "kategori" => $katlab->kategori,
            "keterangan" => $katlab->keterangan,
            "create" => $katlab->create,
            "update" => $katlab->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kategori', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('keterangan', 'zzz', 'trim|required', ["required" => "Keterangan Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataKategoriLaboratorium = [
                // id
                "kategori" => $this->input->post('kategori', true),
                "keterangan" => $this->input->post('keterangan', true),
                "create" => date("Y-m-d H:i:s"),
                // "update"
            ];

            $this->db->insert("katlab", $dataKategoriLaboratorium);

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
            "keterangan_error" => form_error("keterangan"),
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

        $this->db->delete('katlab', ['id' => $this->input->post('id', true)]);

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
        $this->form_validation->set_rules('keterangan', 'zzz', 'trim|required', ["required" => "Keterangan Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataKategoriLaboratorium = [
                // id
                "kategori" => $this->input->post('kategori', true),
                "keterangan" => $this->input->post('keterangan', true),
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $this->db->update("katlab", $dataKategoriLaboratorium, ['id' => $this->input->post('id', true)]);

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
            "keterangan_error" => form_error("keterangan"),
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
