<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_dokumen', 'dokumen');
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxDokumenMutu()
    {
        $this->load->model("datatable/S_dokumen_model", "SDmodel");
        $resuls = $this->SDmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $tombolAksi = '
                <a href="' . base_url() . 'superadmin/dokumen-mutu/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->namadokumen . '</div>';
            $row[] =  '<div class="">' . $result->deskripsi . '</div>';
            $row[] =  '<div class="">' . $result->deskripsidokumen . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
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
    public function getdokumenbyid($id)
    {
        $dokumen = $this->dokumen->getDataById($id);

        $data = [
            "id" => $dokumen->id,
            "mutuid" => $dokumen->mutuid,
            "kodeprodi" => $dokumen->kodeprodi,
            "namadokumen" => $dokumen->namadokumen,
            "deskripsidokumen" => $dokumen->deskripsidokumen,
            "path" => $dokumen->path,
            "create" => $dokumen->create,
            "update" => $dokumen->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $path_pdf_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('mutuid', 'zzz', 'trim|required', ["required" => "Kategori Mutu Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namadokumen', 'zzz', 'trim|required', ["required" => "Nama Dokumen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsidokumen', 'zzz', 'trim|required', ["required" => "Deskripsi Dokumen Tidak Boleh Kosong!"]);


        if ($this->form_validation->run() == FALSE) {
            if ($_FILES['path_pdf']['size'] == 0) {
                $path_pdf_error = "<p>File PDF Tidak Boleh Kosong!</p>";
            }
        } else {
            if ($_FILES['path_pdf']['size'] == 0) {
                $path_pdf_error = "<p>File PDF Tidak Boleh Kosong!</p>";
            }

            if ($path_pdf_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                // Perihal PDF
                $config['upload_path'] = FCPATH . '/assets/pdfDB/dokumen';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'pdf';
                $config['max_size']     = '20000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["path_pdf"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataDokumenMutu = [
                    // id
                    "mutuid" => $this->input->post('mutuid', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "namadokumen" => $this->input->post('namadokumen', true),
                    "deskripsidokumen" => $this->input->post('deskripsidokumen', true),
                    "path" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("dokumen", $dataDokumenMutu);
                if ($query) {
                    if ($this->upload->do_upload('path_pdf')) {
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
            "mutuid_error" => form_error("mutuid"),
            "namadokumen_error" => form_error("namadokumen"),
            "deskripsidokumen_error" => form_error("deskripsidokumen"),
            "path_pdf_error" => $path_pdf_error,
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

        $dokumen = $this->dokumen->getDataById($this->input->post('id', true));

        if ($dokumen->path) {
            unlink(FCPATH . "/assets/pdfDB/dokumen/" . $dokumen->path);
        }

        $this->db->delete('dokumen', ['id' => $this->input->post('id', true)]);

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
        $this->form_validation->set_rules('mutuid', 'zzz', 'trim|required', ["required" => "Kategori Mutu Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namadokumen', 'zzz', 'trim|required', ["required" => "Nama Dokumen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsidokumen', 'zzz', 'trim|required', ["required" => "Deskripsi Dokumen Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $dokumen = $this->dokumen->getDataById($this->input->post('id', true));
            $fileName = $dokumen->path;
            if ($_FILES['path_pdf']['size'] != 0) {
                // Perihal PDF
                $config['upload_path'] = FCPATH . '/assets/pdfDB/dokumen';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'pdf';
                $config['max_size']     = '20000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["path_pdf"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($dokumen->path) {
                    unlink(FCPATH . "/assets/pdfDB/dokumen/" . $dokumen->path);
                }
            }

            $dataDokumenMutu = [
                // id
                "mutuid" => $this->input->post('mutuid', true),
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "namadokumen" => $this->input->post('namadokumen', true),
                "deskripsidokumen" => $this->input->post('deskripsidokumen', true),
                "path" => $fileName,
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("dokumen", $dataDokumenMutu, ['id' => $this->input->post('id', true)]);

            if ($query and $_FILES['path_pdf']['size'] != 0) {
                if ($this->upload->do_upload('path_pdf')) {
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
            "mutuid_error" => form_error("mutuid"),
            "namadokumen_error" => form_error("namadokumen"),
            "deskripsidokumen_error" => form_error("deskripsidokumen"),
            // "path_pdf_error" => $path_pdf_error,
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
