<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxProdi()
    {
        $this->load->model("datatable/S_prodi_model", "SSmodel");
        $resuls = $this->SSmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalProfile(' . "'" . $result->kodeprodi . "'" . ')">Profil</button>
                <button class="btn btn-xs btn-primary btn-flat" onclick="bukaModalVisiMisi(' . "'" . $result->kodeprodi . "'" . ')">Visi-Misi</i></button>
                <a href="' . base_url() . 'superadmin/visi-misi-prodi/edit/' . $result->kodeprodi . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->kodeprodi . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->kodeprodi . '</div>';
            $row[] =  '<div class="">' . $result->namaprodi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SSmodel->count_all_data(),
            "recordsFiltered" => $this->SSmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getprodibykode($kode)
    {
        $prodi = $this->prodi->getDataByKode($kode);

        $data = [
            "kodeprodi" => $prodi->kodeprodi,
            "namaprodi" => $prodi->namaprodi,
            "profile" => $prodi->profile,
            "visimisi" => $prodi->visimisi,
            "create" => $prodi->create,
            "update" => $prodi->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $kodeprodi_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Kode Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namaprodi', 'zzz', 'trim|required', ["required" => "Nama Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('profile', 'zzz', 'trim|required', ["required" => "Profil Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('visimisi', 'zzz', 'trim|required', ["required" => "VisiMisi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            $kodeprodi_error = form_error("kodeprodi");
            if ($this->input->post('kodeprodi', true)) {
                $cekKodeProdi = $this->prodi->getDataByKode($this->input->post('kodeprodi', true));
                if ($cekKodeProdi) {
                    $kodeprodi_error = '<p>Kode Prodi sudah ada (Tidak Boleh Sama)</p>';
                }
            }
        } else {
            $kodeprodi_error = form_error("kodeprodi");
            if ($this->input->post('kodeprodi', true)) {
                $cekKodeProdi = $this->prodi->getDataByKode($this->input->post('kodeprodi', true));
                if ($cekKodeProdi) {
                    $kodeprodi_error = '<p>Kode Prodi sudah ada (Tidak Boleh Sama)</p>';
                }
            }

            if ($kodeprodi_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                $dataProdi = [
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "namaprodi" => $this->input->post('namaprodi', true),
                    "profile" => $this->input->post('profile', true),
                    "visimisi" => $this->input->post('visimisi', true),
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $this->db->insert("prodi", $dataProdi);

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
            "kodeprodi_error" => $kodeprodi_error,
            "namaprodi_error" => form_error("namaprodi"),
            "profile_error" => form_error("profile"),
            "visimisi_error" => form_error("visimisi"),
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

        $this->db->delete('prodi', ['kodeprodi' => $this->input->post('kodeprodi', true)]);

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
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Kode Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namaprodi', 'zzz', 'trim|required', ["required" => "Nama Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('profile', 'zzz', 'trim|required', ["required" => "Profil Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('visimisi', 'zzz', 'trim|required', ["required" => "VisiMisi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            $kodeprodi_error = form_error("kodeprodi");
            if ($this->input->post('kodeprodi', true)) {
                $cekKodeProdi = $this->prodi->getDataByKode($this->input->post('kodeprodi', true));
                if ($cekKodeProdi and $cekKodeProdi->kodeprodi != $this->input->post('kodeprodi_awal', true)) {
                    $kodeprodi_error = '<p>Kode Prodi sudah ada (Tidak Boleh Sama)</p>';
                }
            }
        } else {
            $kodeprodi_error = form_error("kodeprodi");
            if ($this->input->post('kodeprodi', true)) {
                $cekKodeProdi = $this->prodi->getDataByKode($this->input->post('kodeprodi', true));
                if ($cekKodeProdi and $cekKodeProdi->kodeprodi != $this->input->post('kodeprodi_awal', true)) {
                    $kodeprodi_error = '<p>Kode Prodi sudah ada (Tidak Boleh Sama)</p>';
                }
            }

            if ($kodeprodi_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                $dataProdi = [
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "namaprodi" => $this->input->post('namaprodi', true),
                    "profile" => $this->input->post('profile', true),
                    "visimisi" => $this->input->post('visimisi', true),
                    // "create"
                    "update" => date("Y-m-d H:i:s"),
                ];

                $this->db->update("prodi", $dataProdi, ['kodeprodi' => $this->input->post('kodeprodi', true)]);

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
            "kodeprodi_error" => $kodeprodi_error,
            "namaprodi_error" => form_error("namaprodi"),
            "profile_error" => form_error("profile"),
            "visimisi_error" => form_error("visimisi"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
