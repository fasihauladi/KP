<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_peta', 'peta');
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxPetaPenelitian()
    {
        $this->load->model("datatable/S_peta_model", "SPmodel");
        $resuls = $this->SPmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/peta-penelitian/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];

            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->namadok . '</div>';
            $row[] =  '<div class="">' . $result->kategori . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SPmodel->count_all_data(),
            "recordsFiltered" => $this->SPmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getpetabyid($id)
    {
        $peta = $this->peta->getDataById($id);

        $data = [
            "id" => $peta->id,
            "kodeprodi" => $peta->kodeprodi,
            "kategori" => $peta->kategori,
            "namadok" => $peta->namadok,
            "deskripsi" => $peta->deskripsi,
            "berkasphp" => $peta->berkasphp,
            "create" => $peta->create,
            "update" => $peta->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kategori', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namadok', 'zzz', 'trim|required', ["required" => "Nama Dokumen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataPetaPenelitian = [
                // id
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "kategori" => $this->input->post('kategori', true),
                "namadok" => $this->input->post('namadok', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                // berkasphp
                "create" => date("Y-m-d H:i:s"),
                // "update"
            ];

            $this->db->insert("peta", $dataPetaPenelitian);

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
            "kategori_error" => form_error("kategori"),
            "namadok_error" => form_error("namadok"),
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

        $this->db->delete('peta', ['id' => $this->input->post('id', true)]);

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
        $kodeprodi_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kategori', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namadok', 'zzz', 'trim|required', ["required" => "Nama Dokumen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dataPetaPenelitian = [
                // id
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "kategori" => $this->input->post('kategori', true),
                "namadok" => $this->input->post('namadok', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                // berkasphp
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $this->db->update("peta", $dataPetaPenelitian, ['id' => $this->input->post('id', true)]);

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
            "kategori_error" => form_error("kategori"),
            "namadok_error" => form_error("namadok"),
            "deskripsi_error" => form_error("deskripsi"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
