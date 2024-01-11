<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyalab extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_karyalab', 'karyalab');
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_laboratorium', 'laboratorium');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxKaryaLaboratorium()
    {
        $this->load->model("datatable/S_karya_laboratorium_model", "SKLmodel");
        $resuls = $this->SKLmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $lab = $this->laboratorium->getDataByKode($result->kodelab)->namalab;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/karya-laboratorium/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->namakarya . '</div>';
            $row[] =  '<div class="">' . $lab . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
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
    public function getkaryalabbyid($id)
    {
        $karyalab = $this->karyalab->getDataById($id);

        $data = [
            "id" => $karyalab->id,
            "kodelab" => $karyalab->kodelab,
            "kodeprodi" => $karyalab->kodeprodi,
            "namakarya" => $karyalab->namakarya,
            "deskripsikarya" => $karyalab->deskripsikarya,
            "foto" => $karyalab->foto,
            "create" => $karyalab->create,
            "update" => $karyalab->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kodelab', 'zzz', 'trim|required', ["required" => "Laboratorium Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namakarya', 'zzz', 'trim|required', ["required" => "Nama Karya Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsikarya', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/karya/lab';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataKaryaLaboratorium = [
                    // id
                    "kodelab" => $this->input->post('kodelab', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "namakarya" => $this->input->post('namakarya', true),
                    "deskripsikarya" => $this->input->post('deskripsikarya', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("karyalab", $dataKaryaLaboratorium);
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
            "kodelab_error" => form_error("kodelab"),
            "namakarya_error" => form_error("namakarya"),
            "foto_error" => $foto_error,
            "deskripsikarya_error" => form_error("deskripsikarya"),
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

        $karyalab = $this->karyalab->getDataById($this->input->post('id', true));

        if ($karyalab->foto) {
            unlink(FCPATH . "/assets/gambarDB/karya/lab/" . $karyalab->foto);
        }

        $this->db->delete('karyalab', ['id' => $karyalab->id]);

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
        $this->form_validation->set_rules('kodelab', 'zzz', 'trim|required', ["required" => "Laboratorium Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namakarya', 'zzz', 'trim|required', ["required" => "Nama Karya Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsikarya', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $karyalab = $this->karyalab->getDataById($this->input->post('id', true));
            $fileName = $karyalab->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/karya/lab/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($karyalab->foto) {
                    unlink(FCPATH . "/assets/gambarDB/karya/lab/" . $karyalab->foto);
                }
            }

            $dataKaryaLaboratorium = [
                // id
                "kodelab" => $this->input->post('kodelab', true),
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "namakarya" => $this->input->post('namakarya', true),
                "deskripsikarya" => $this->input->post('deskripsikarya', true),
                "foto" => $fileName,
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("karyalab", $dataKaryaLaboratorium, ['id' => $this->input->post('id', true)]);

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
            "kodelab_error" => form_error("kodelab"),
            "namakarya_error" => form_error("namakarya"),
            // "foto_error" => $foto_error,
            "deskripsikarya_error" => form_error("deskripsikarya"),
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
