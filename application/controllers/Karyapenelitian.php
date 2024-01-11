<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyapenelitian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_karyapenelitian', 'karyapenelitian');
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_katpenelitian', 'katpenelitian');
        $this->load->model('M_dosen', 'dosen');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxKaryaPenelitian()
    {
        $this->load->model("datatable/S_karya_penelitian_model", "SKPmodel");
        $resuls = $this->SKPmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $dosen = $this->dosen->getDataByNip($result->nip);

            $katpenelitian = $this->katpenelitian->getDataById($result->katpenelitianid);


            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/karya-penelitian/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $dosen->nama . ' (' . $dosen->nip . ')' . '</div>';
            $row[] =  '<div class="">' . $result->judul . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . '(' . $katpenelitian->namakatpen . ') ' . $katpenelitian->namasubkatpen . '</div>';
            $row[] =  '<div class="">' . $result->sumberdana . '</div>';
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
    public function getkaryapenelitianbyid($id)
    {
        $karyapenelitian = $this->karyapenelitian->getDataById($id);

        $data = [
            "id" => $karyapenelitian->id,
            "nip" => $karyapenelitian->nip,
            "kodeprodi" => $karyapenelitian->kodeprodi,
            "katpenelitianid" => $karyapenelitian->katpenelitianid,
            "judul" => $karyapenelitian->judul,
            "sumberdana" => $karyapenelitian->sumberdana,
            "deskripsi" => $karyapenelitian->deskripsi,
            "foto" => $karyapenelitian->foto,
            "create" => $karyapenelitian->create,
            "update" => $karyapenelitian->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('katpenelitianid', 'zzz', 'trim|required', ["required" => "Kategori Penelitian Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "Dosen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('judul', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('sumberdana', 'zzz', 'trim|required', ["required" => "Sumber Dana Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/karya/penelitian';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataKaryaPenelitian = [
                    // id
                    "nip" => $this->input->post('nip', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "katpenelitianid" => $this->input->post('katpenelitianid', true),
                    "judul" => $this->input->post('judul', true),
                    "sumberdana" => $this->input->post('sumberdana', true),
                    "deskripsi" => $this->input->post('deskripsi', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("karyapenelitian", $dataKaryaPenelitian);
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
            "katpenelitianid_error" => form_error("katpenelitianid"),
            "nip_error" => form_error("nip"),
            "judul_error" => form_error("judul"),
            "sumberdana_error" => form_error("sumberdana"),
            "foto_error" => $foto_error,
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

        $karyapenelitian = $this->karyapenelitian->getDataById($this->input->post('id', true));

        if ($karyapenelitian->foto) {
            unlink(FCPATH . "/assets/gambarDB/karya/penelitian/" . $karyapenelitian->foto);
        }

        $this->db->delete('karyapenelitian', ['id' => $karyapenelitian->id]);

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
        $this->form_validation->set_rules('katpenelitianid', 'zzz', 'trim|required', ["required" => "Kategori Penelitian Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "Dosen Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('judul', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('sumberdana', 'zzz', 'trim|required', ["required" => "Sumber Dana Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $karyapenelitian = $this->karyapenelitian->getDataById($this->input->post('id', true));
            $fileName = $karyapenelitian->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/karya/penelitian/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($karyapenelitian->foto) {
                    unlink(FCPATH . "/assets/gambarDB/karya/penelitian/" . $karyapenelitian->foto);
                }
            }

            $dataKaryaPenelitian = [
                // id
                "nip" => $this->input->post('nip', true),
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "katpenelitianid" => $this->input->post('katpenelitianid', true),
                "judul" => $this->input->post('judul', true),
                "sumberdana" => $this->input->post('sumberdana', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                "foto" => $fileName,
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("karyapenelitian", $dataKaryaPenelitian, ['id' => $this->input->post('id', true)]);

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
            "katpenelitianid_error" => form_error("katpenelitianid"),
            "nip_error" => form_error("nip"),
            "judul_error" => form_error("judul"),
            "sumberdana_error" => form_error("sumberdana"),
            // "foto_error" => $foto_error,
            "deskripsi_error" => form_error("deskripsi"),
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
