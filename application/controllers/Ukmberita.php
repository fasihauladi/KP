<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ukmberita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_ukmberita', 'ukmberita');
        $this->load->model('M_ukm', 'ukm');
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_prestasi', 'prestasi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxUKMBerita()
    {
        $this->load->model("datatable/S_ukm_berita_model", "SUBmodel");
        $resuls = $this->SUBmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $tanggal = $this->prestasi->cekWaktuIndonesia($result->tanggal);

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $ukm = $this->ukm->getDataById($result->ukmid)->nama;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/seputar-ukm/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];

            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $tanggal . '</div>';
            $row[] =  '<div class="">' . $result->judul . '</div>';
            $row[] =  '<div class="">' . $ukm . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SUBmodel->count_all_data(),
            "recordsFiltered" => $this->SUBmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getukmberitabyid($id)
    {
        $ukmberita = $this->ukmberita->getDataById($id);

        $data = [
            "id" => $ukmberita->id,
            "ukmid" => $ukmberita->ukmid,
            "kodeprodi" => $ukmberita->kodeprodi,
            "judul" => $ukmberita->judul,
            "content" => $ukmberita->content,
            "foto" => $ukmberita->foto,
            "thumbnail" => $ukmberita->thumbnail,
            "tanggal" => $ukmberita->tanggal,
            "create" => $ukmberita->create,
            "update" => $ukmberita->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $thumbnail_error = '';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('ukmid', 'zzz', 'trim|required', ["required" => "UKM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('judul', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('tanggal', 'zzz', 'trim|required', ["required" => "Tanggal Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('content', 'zzz', 'trim|required', ["required" => "Konten Tidak Boleh Kosong!"]);
        if ($this->form_validation->run() == FALSE) {
            if ($_FILES['thumbnail']['size'] == 0) {
                $thumbnail_error = "<p>Thumbnail Tidak Boleh Kosong!</p>";
            }
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            }
        } else {
            if ($_FILES['thumbnail']['size'] == 0) {
                $thumbnail_error = "<p>Thumbnail Tidak Boleh Kosong!</p>";
            }
            if ($_FILES['foto']['size'] == 0) {
                $foto_error = "<p>Foto Tidak Boleh Kosong!</p>";
            }

            if ($thumbnail_error == '' and $foto_error == '') {
                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

                // Perihal Thumbnail
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/ukm/';
                $config['file_name'] = 't' . date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["thumbnail"]["name"]);
                $extension = $path_parts['extension'];
                $fileName1 = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('thumbnail')) {
                    $this->upload->data('file_name');
                }

                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/ukm/';
                $config['file_name'] = 'f' . date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName2 = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto')) {
                    $this->upload->data('file_name');
                }

                $dataBerita = [
                    // "id"
                    "ukmid" => $this->input->post('ukmid', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "judul" => $this->input->post('judul', true),
                    "content" => $this->input->post('content', true),
                    "foto" => $fileName2,
                    "thumbnail" => $fileName1,
                    "tanggal" => $this->input->post('tanggal', true),
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("ukmberita", $dataBerita);

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
            "ukmid_error" => form_error("ukmid"),
            "judul_error" => form_error("judul"),
            "content_error" => form_error("content"),
            "thumbnail_error" => $thumbnail_error,
            "tanggal_error" => form_error("tanggal"),
            "foto_error" => $foto_error,
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

        $berita = $this->ukmberita->getDataById($this->input->post('id', true));

        if ($berita->thumbnail) {
            unlink(FCPATH . "/assets/gambarDB/berita/ukm/" . $berita->thumbnail);
        }

        if ($berita->foto) {
            unlink(FCPATH . "/assets/gambarDB/berita/ukm/" . $berita->foto);
        }

        $this->db->delete('ukmberita', ['id' => $berita->id]);

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
        $this->form_validation->set_rules('ukmid', 'zzz', 'trim|required', ["required" => "UKM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('judul', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('tanggal', 'zzz', 'trim|required', ["required" => "Tanggal Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('content', 'zzz', 'trim|required', ["required" => "Konten Tidak Boleh Kosong!"]);
        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 


            $ukmberita = $this->ukmberita->getDataById($this->input->post('id', true));

            // Thumbnail
            $fileName1 = $ukmberita->thumbnail;
            if ($_FILES['thumbnail']['size'] != 0) {
                // Perihal thumbnail
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/ukm/';
                $config['file_name'] = 't' . date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["thumbnail"]["name"]);
                $extension = $path_parts['extension'];
                $fileName1 = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('thumbnail')) {
                    $this->upload->data('file_name');
                }

                if ($ukmberita->thumbnail) {
                    unlink(FCPATH . "/assets/gambarDB/berita/ukm/" . $ukmberita->thumbnail);
                }
            }

            // Foto
            $fileName2 = $ukmberita->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/ukm/';
                $config['file_name'] = 'f' . date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName2 = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto')) {
                    $this->upload->data('file_name');
                }
                if ($ukmberita->foto) {
                    unlink(FCPATH . "/assets/gambarDB/berita/ukm/" . $ukmberita->foto);
                }
            }

            $dataBerita = [
                // "id"
                "ukmid" => $this->input->post('ukmid', true),
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "judul" => $this->input->post('judul', true),
                "content" => $this->input->post('content', true),
                "foto" => $fileName2,
                "thumbnail" => $fileName1,
                "tanggal" => $this->input->post('tanggal', true),
                // "create",
                "update" => date('Y-m-d H:i:s'),
            ];

            $this->db->update("ukmberita", $dataBerita, ['id' => $this->input->post('id', true)]);

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
            "ukmid_error" => form_error("ukmid"),
            "judul_error" => form_error("judul"),
            "tanggal_error" => form_error("tanggal"),
            "content_error" => form_error("content"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
