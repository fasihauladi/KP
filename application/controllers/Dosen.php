<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_dosen', 'dosen');
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_bidminat', 'bidminat');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxDosen()
    {
        $this->load->model("datatable/S_dosen_model", "SDmodel");
        $resuls = $this->SDmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $bidangMinat = $this->bidminat->getDataById($result->bidminatid)->namabidminat;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->nip . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/dosen/edit/' . $result->nip . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->nip . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->nip . '</div>';
            $row[] =  '<div class="">' . $result->nama . '</div>';
            $row[] =  '<div class="">' . $result->email . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $bidangMinat . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SDmodel->count_all_data(),
            "recordsFiltered" => $this->SDmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getdosenbynip($nip)
    {
        $dosen = $this->dosen->getDataByNip($nip);

        $data = [
            "nip" => $dosen->nip,
            "bidminatid" => $dosen->bidminatid,
            "kodeprodi" => $dosen->kodeprodi,
            "nama" => $dosen->nama,
            "email" => $dosen->email,
            "foto" => $dosen->foto,
            "penelitian" => $dosen->penelitian,
            "create" => $dosen->create,
            "update" => $dosen->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';
        $nip_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "NIP Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('email', 'zzz', 'trim|required|valid_email', ["required" => "Email Tidak Boleh Kosong!", "valid_email" => "Email Tidak Valid !!"]);
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('bidminatid', 'zzz', 'trim|required', ["required" => "Bidang Minat Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('penelitian', 'zzz', 'trim|required', ["required" => "Penelitian Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            } else {
                $foto_error = '';
            }

            $nip_error = form_error("nip");
            if ($this->input->post('nip', true)) {
                $cekNIP = $this->dosen->getDataByNip($this->input->post('nip', true));
                if ($cekNIP) {
                    $nip_error = '<p>NIP sudah ada (Tidak Boleh Sama)</p>';
                }
            }
        } else {
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            } else {
                $foto_error = '';
            }

            $nip_error = form_error("nip");
            if ($this->input->post('nip', true)) {
                $cekNIP = $this->dosen->getDataByNip($this->input->post('nip', true));
                if ($cekNIP) {
                    $nip_error = '<p>NIP sudah ada (Tidak Boleh Sama)</p>';
                }
            }

            if ($foto_error == '' and $nip_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/dosen/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataDosen = [
                    "nip" => $this->input->post('nip', true),
                    "bidminatid" => $this->input->post('bidminatid', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "nama" => $this->input->post('nama', true),
                    "email" => $this->input->post('email', true),
                    "foto" => $fileName,
                    "penelitian" => $this->input->post('penelitian', true),
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("dosen", $dataDosen);
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
            "nip_error" => $nip_error,
            "nama_error" => form_error("nama"),
            "email_error" => form_error("email"),
            "kodeprodi_error" => form_error("kodeprodi"),
            "bidminatid_error" => form_error("bidminatid"),
            "foto_error" => $foto_error,
            "penelitian_error" => form_error("penelitian"),
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

        $dosen = $this->dosen->getDataByNip($this->input->post('nip', true));

        if ($dosen->foto) {
            unlink(FCPATH . "/assets/gambarDB/dosen/" . $dosen->foto);
        }

        $this->db->delete('dosen', ['nip' => $dosen->nip]);

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
        $nip_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "NIP Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nama', 'zzz', 'trim|required', ["required" => "Nama Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('email', 'zzz', 'trim|required|valid_email', ["required" => "Email Tidak Boleh Kosong!", "valid_email" => "Email Tidak Valid !!"]);
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('bidminatid', 'zzz', 'trim|required', ["required" => "Bidang Minat Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('penelitian', 'zzz', 'trim|required', ["required" => "Penelitian Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            $nip_error = form_error("nip");
            if ($this->input->post('nip', true)) {
                $cekNip = $this->dosen->getDataByNip($this->input->post('nip', true));
                if ($cekNip and $cekNip->nip != $this->input->post('nip_awal', true)) {
                    $nip_error = '<p>NIP sudah ada (Tidak Boleh Sama)</p>';
                }
            }
        } else {
            $nip_error = form_error("nip");
            if ($this->input->post('nip', true)) {
                $cekNip = $this->dosen->getDataByNip($this->input->post('nip', true));
                if ($cekNip and $cekNip->nip != $this->input->post('nip_awal', true)) {
                    $nip_error = '<p>NIP sudah ada (Tidak Boleh Sama)</p>';
                }
            }

            if ($nip_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                $dosen = $this->dosen->getDataByNip($this->input->post('nip_awal', true));
                $fileName = $dosen->foto;
                if ($_FILES['foto']['size'] != 0) {
                    // Perihal foto
                    $config['upload_path'] = FCPATH . '/assets/gambarDB/dosen/';
                    $config['file_name'] = date("YmdHis") . uniqid();
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size']     = '10000';
                    $config['overwrite']     = TRUE;
                    $path_parts = pathinfo($_FILES["foto"]["name"]);
                    $extension = $path_parts['extension'];
                    $fileName = $config['file_name'] . "." . $extension;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($dosen->foto) {
                        unlink(FCPATH . "/assets/gambarDB/dosen/" . $dosen->foto);
                    }
                }

                $dataDosen = [
                    "nip" => $this->input->post('nip', true),
                    "bidminatid" => $this->input->post('bidminatid', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "nama" => $this->input->post('nama', true),
                    "email" => $this->input->post('email', true),
                    "foto" => $fileName,
                    "penelitian" => $this->input->post('penelitian', true),
                    // "create"
                    "update" => date("Y-m-d H:i:s"),
                ];

                $query = $this->db->update("dosen", $dataDosen, ['nip' => $this->input->post('nip_awal', true)]);

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
        }

        $data = [
            "nip_error" => $nip_error,
            "nama_error" => form_error("nama"),
            "email_error" => form_error("email"),
            "kodeprodi_error" => form_error("kodeprodi"),
            "bidminatid_error" => form_error("bidminatid"),
            // "foto_error" => $foto_error,
            "penelitian_error" => form_error("penelitian"),
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
