<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katjabatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_katjabatan', 'katjabatan');
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxKategoriJabatan()
    {
        $this->load->model("datatable/S_kategori_jabatan_model", "SKJmodel");
        $resuls = $this->SKJmodel->getDataTable();
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

            $tombolAksi = '
                <a href="' . base_url() . 'superadmin/kategori-jabatan/edit/' . $result->kodejabatan . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->kodejabatan . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->kodejabatan . '</div>';
            $row[] =  '<div class="">' . $result->jabatan . '</div>';
            $row[] =  '<div class="">' . $result->deskripsi . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SKJmodel->count_all_data(),
            "recordsFiltered" => $this->SKJmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getkatjabatanbykode($kode)
    {
        $katjabatan = $this->katjabatan->getDataByKode($kode);

        $data = [
            "kodejabatan" => $katjabatan->kodejabatan,
            "jabatan" => $katjabatan->jabatan,
            "deskripsi" => $katjabatan->deskripsi,
            "create" => $katjabatan->create,
            "update" => $katjabatan->update,
            "kodeprodi" => $katjabatan->kodeprodi,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';

        // konfigurasi form validasi
        $this->form_validation->set_rules('jabatan', 'zzz', 'trim|required', ["required" => "Jabatan Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction

            if ($this->input->post('kodeprodi', true)) {
                $kodeprodi = $this->input->post('kodeprodi', true);
            } else {
                $kodeprodi = null;
            }

            $dataKategoriJabatan = [
                "kodejabatan" => $this->input->post('kodejabatan', true),
                "jabatan" => $this->input->post('jabatan', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                "kodeprodi" => $kodeprodi,
                "create" => date("Y-m-d H:i:s"),
                // "update"
            ];

            $this->db->insert("katjabatan", $dataKategoriJabatan);

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
            "jabatan_error" => form_error("jabatan"),
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

        $this->db->delete('katjabatan', ['kodejabatan' => $this->input->post('kodejabatan', true)]);

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
        $kodejabatan_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodejabatan', 'zzz', 'trim|required', ["required" => "Kode Jabatan Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('jabatan', 'zzz', 'trim|required', ["required" => "Jabatan Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            $kodejabatan_error = form_error("kodejabatan");
            if ($this->input->post('kodejabatan', true)) {
                $cekKodeJabatan = $this->katjabatan->getDataByKode($this->input->post('kodejabatan', true));
                if ($cekKodeJabatan and $cekKodeJabatan->kodejabatan != $this->input->post('kodejabatan_awal', true)) {
                    $kodejabatan_error = '<p>Kode Jabatan sudah ada (Tidak Boleh Sama)</p>';
                }
            }
        } else {
            $kodejabatan_error = form_error("kodejabatan");
            if ($this->input->post('kodejabatan', true)) {
                $cekKodeJabatan = $this->katjabatan->getDataByKode($this->input->post('kodejabatan', true));
                if ($cekKodeJabatan and $cekKodeJabatan->kodejabatan != $this->input->post('kodejabatan_awal', true)) {
                    $kodejabatan_error = '<p>Kode Jabatan sudah ada (Tidak Boleh Sama)</p>';
                }
            }

            if ($kodejabatan_error == '') {

                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction

                if ($this->input->post('kodeprodi', true)) {
                    $kodeprodi = $this->input->post('kodeprodi', true);
                } else {
                    $kodeprodi = null;
                }

                $dataKategoriJabatan = [
                    "kodejabatan" => $this->input->post('kodejabatan', true),
                    "jabatan" => $this->input->post('jabatan', true),
                    "deskripsi" => $this->input->post('deskripsi', true),
                    "kodeprodi" => $kodeprodi,
                    // "create"
                    "update" => date("Y-m-d H:i:s"),
                ];

                $this->db->update("katjabatan", $dataKategoriJabatan, ['kodejabatan' => $this->input->post('kodejabatan_awal', true)]);

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
            "kodejabatan_error" => $kodejabatan_error,
            "jabatan_error" => form_error("jabatan"),
            "deskripsi_error" => form_error("deskripsi"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
