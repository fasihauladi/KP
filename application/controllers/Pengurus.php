<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_pengurus', 'pengurus');
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_dosen', 'dosen');
        $this->load->model('M_katjabatan', 'katjabatan');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxPengurus()
    {
        $this->load->model("datatable/S_pengurus_model", "SPmodel");
        $resuls = $this->SPmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi);

            if ($prodi) {
                $prodi = $prodi->namaprodi;
            } else {
                $prodi = '-';
            }

            $dosen = $this->dosen->getDataByNip($result->nip);

            $jabatan = $this->katjabatan->getDataByKode($result->kodejabatan)->jabatan;

            $tombolAksi = '
                <a href="' . base_url() . 'superadmin/pengurus/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $dosen->nama . ' (' . $dosen->nip . ')' . '</div>';
            $row[] =  '<div class="">' . $jabatan . '</div>';
            $row[] =  '<div class="">' . $result->tahun . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $result->deskripsi . '</div>';
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
    public function getpengurusbyid($id)
    {
        $pengurus = $this->pengurus->getDataById($id);

        $data = [
            "id" => $pengurus->id,
            "nip" => $pengurus->nip,
            "kodejabatan" => $pengurus->kodejabatan,
            "kodeprodi" => $pengurus->kodeprodi,
            "skjabatan" => $pengurus->skjabatan,
            "tahun" => $pengurus->tahun,
            "deskripsi" => $pengurus->deskripsi,
            "create" => $pengurus->create,
            "update" => $pengurus->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';

        // konfigurasi form validasi
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "Dosen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kodejabatan', 'zzz', 'trim|required', ["required" => "Jabatan Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('tahun', 'zzz', 'trim|required', ["required" => "Tahun Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            if ($this->input->post('kodeprodi', true) == 'null') {
                $kodeprodi = null;
            } else {
                $kodeprodi = $this->input->post('kodeprodi', true);
            }

            $dataPengurus = [
                // id
                "nip" => $this->input->post('nip', true),
                "kodejabatan" => $this->input->post('kodejabatan', true),
                "kodeprodi" => $kodeprodi,
                // skjabatan
                "tahun" => $this->input->post('tahun', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                "create" => date("Y-m-d H:i:s"),
                // "update"
            ];

            $this->db->insert("pengurus", $dataPengurus);

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
            "nip_error" => form_error("nip"),
            "kodejabatan_error" => form_error("kodejabatan"),
            "tahun_error" => form_error("tahun"),
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

        $this->db->delete('pengurus', ['id' => $this->input->post('id', true)]);

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
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "Dosen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kodejabatan', 'zzz', 'trim|required', ["required" => "Jabatan Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('tahun', 'zzz', 'trim|required', ["required" => "Tahun Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            if (!$this->input->post('kodeprodi', true)) {
                $kodeprodi = null;
            } else {
                $kodeprodi = $this->input->post('kodeprodi', true);
            }

            $dataPengurus = [
                // id
                "nip" => $this->input->post('nip', true),
                "kodejabatan" => $this->input->post('kodejabatan', true),
                "kodeprodi" => $kodeprodi,
                // skjabatan
                "tahun" => $this->input->post('tahun', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $this->db->update("pengurus", $dataPengurus, ['id' => $this->input->post('id', true)]);

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
            "nip_error" => form_error("nip"),
            "kodejabatan_error" => form_error("kodejabatan"),
            "tahun_error" => form_error("tahun"),
            "deskripsi_error" => form_error("deskripsi"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
