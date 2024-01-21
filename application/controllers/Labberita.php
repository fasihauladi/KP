<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Labberita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_labberita', 'labberita');
        $this->load->model('M_laboratorium', 'laboratorium');
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_prestasi', 'prestasi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxLabBerita()
    {
        $this->load->model("datatable/S_labberita_model", "SLmodel");
        $resuls = $this->SLmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $tanggal = $this->prestasi->cekWaktuIndonesia($result->tanggal);

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $lab = $this->laboratorium->getDataByKode($result->kodelab)->namalab;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/seputar-laboratorium/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];

            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $tanggal . '</div>';
            $row[] =  '<div class="">' . $result->judulberita . '</div>';
            $row[] =  '<div class="">' . $lab . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SLmodel->count_all_data(),
            "recordsFiltered" => $this->SLmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getlabberitabyid($id)
    {
        $labberita = $this->labberita->getDataById($id);

        $data = [
            "id" => $labberita->id,
            "kodelab" => $labberita->kodelab,
            "kodeprodi" => $labberita->kodeprodi,
            "judulberita" => $labberita->judulberita,
            "content" => $labberita->content,
            "foto" => $labberita->foto,
            "thumbnail" => $labberita->thumbnail,
            "tanggal" => $labberita->tanggal,
            "create" => $labberita->create,
            "update" => $labberita->update,
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
        $this->form_validation->set_rules('kodelab', 'zzz', 'trim|required', ["required" => "Laboratorium Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('judulberita', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/lab/';
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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/lab/';
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
                    "kodelab" => $this->input->post('kodelab', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "judulberita" => $this->input->post('judulberita', true),
                    "content" => $this->input->post('content', true),
                    "foto" => $fileName2,
                    "thumbnail" => $fileName1,
                    "tanggal" => $this->input->post('tanggal', true),
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("labberita", $dataBerita);

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
            "judulberita_error" => form_error("judulberita"),
            "tanggal_error" => form_error("tanggal"),
            "content_error" => form_error("content"),
            "thumbnail_error" => $thumbnail_error,
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

        $berita = $this->labberita->getDataById($this->input->post('id', true));

        if ($berita->thumbnail) {
            unlink(FCPATH . "/assets/gambarDB/berita/lab/" . $berita->thumbnail);
        }

        if ($berita->foto) {
            unlink(FCPATH . "/assets/gambarDB/berita/lab/" . $berita->foto);
        }

        $this->db->delete('labberita', ['id' => $berita->id]);

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
        $this->form_validation->set_rules('judulberita', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('tanggal', 'zzz', 'trim|required', ["required" => "Tanggal Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('content', 'zzz', 'trim|required', ["required" => "Konten Tidak Boleh Kosong!"]);
        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 


            $labberita = $this->labberita->getDataById($this->input->post('id', true));

            // Thumbnail
            $fileName1 = $labberita->thumbnail;
            if ($_FILES['thumbnail']['size'] != 0) {
                // Perihal thumbnail
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/lab/';
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

                if ($labberita->thumbnail) {
                    unlink(FCPATH . "/assets/gambarDB/berita/lab/" . $labberita->thumbnail);
                }
            }

            // Foto
            $fileName2 = $labberita->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/lab/';
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
                if ($labberita->foto) {
                    unlink(FCPATH . "/assets/gambarDB/berita/lab/" . $labberita->foto);
                }
            }

            $dataBerita = [
                // "id"
                "kodelab" => $this->input->post('kodelab', true),
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "judulberita" => $this->input->post('judulberita', true),
                "content" => $this->input->post('content', true),
                "foto" => $fileName2,
                "thumbnail" => $fileName1,
                "tanggal" => $this->input->post('tanggal', true),
                // "create",
                "update" => date('Y-m-d H:i:s'),
            ];

            $this->db->update("labberita", $dataBerita, ['id' => $this->input->post('id', true)]);

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
            "judulberita_error" => form_error("judulberita"),
            "tanggal_error" => form_error("tanggal"),
            "content_error" => form_error("content"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
