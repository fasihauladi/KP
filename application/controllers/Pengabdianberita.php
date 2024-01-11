<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengabdianberita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_pengabdianberita', 'pengabdianberita');
        $this->load->model('M_prodi', 'prodi');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxPengabdianBerita()
    {
        $this->load->model("datatable/S_pengabdian_berita_model", "SPBmodel");
        $resuls = $this->SPBmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/seputar-pengabdian/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];

            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->judul . '</div>';
            $row[] =  '<div class="">' . $prodi . '</div>';
            $row[] =  '<div class="">' . $tombolAksi . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SPBmodel->count_all_data(),
            "recordsFiltered" => $this->SPBmodel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    public function getpengabdianberitabyid($id)
    {
        $pengabdianberita = $this->pengabdianberita->getDataById($id);

        $data = [
            "id" => $pengabdianberita->id,
            "kodeprodi" => $pengabdianberita->kodeprodi,
            "judul" => $pengabdianberita->judul,
            "content" => $pengabdianberita->content,
            "foto" => $pengabdianberita->foto,
            "thumbnail" => $pengabdianberita->thumbnail,
            "create" => $pengabdianberita->create,
            "update" => $pengabdianberita->update,
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
        $this->form_validation->set_rules('judul', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/pengabdian/';
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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/pengabdian/';
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
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "judul" => $this->input->post('judul', true),
                    "content" => $this->input->post('content', true),
                    "foto" => $fileName2,
                    "thumbnail" => $fileName1,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("pengabdianberita", $dataBerita);

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
            "judul_error" => form_error("judul"),
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

        $berita = $this->pengabdianberita->getDataById($this->input->post('id', true));

        if ($berita->thumbnail) {
            unlink(FCPATH . "/assets/gambarDB/berita/pengabdian/" . $berita->thumbnail);
        }

        if ($berita->foto) {
            unlink(FCPATH . "/assets/gambarDB/berita/pengabdian/" . $berita->foto);
        }

        $this->db->delete('pengabdianberita', ['id' => $berita->id]);

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
        $this->form_validation->set_rules('judul', 'zzz', 'trim|required', ["required" => "Judul Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('content', 'zzz', 'trim|required', ["required" => "Konten Tidak Boleh Kosong!"]);
        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 


            $pengabdianberita = $this->pengabdianberita->getDataById($this->input->post('id', true));

            // Thumbnail
            $fileName1 = $pengabdianberita->thumbnail;
            if ($_FILES['thumbnail']['size'] != 0) {
                // Perihal thumbnail
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/pengabdian/';
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

                if ($pengabdianberita->thumbnail) {
                    unlink(FCPATH . "/assets/gambarDB/berita/pengabdian/" . $pengabdianberita->thumbnail);
                }
            }

            // Foto
            $fileName2 = $pengabdianberita->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/berita/pengabdian/';
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
                if ($pengabdianberita->foto) {
                    unlink(FCPATH . "/assets/gambarDB/berita/pengabdian/" . $pengabdianberita->foto);
                }
            }

            $dataBerita = [
                // "id"
                "kodeprodi" => $this->input->post('kodeprodi', true),
                "judul" => $this->input->post('judul', true),
                "content" => $this->input->post('content', true),
                "foto" => $fileName2,
                "thumbnail" => $fileName1,
                // "create",
                "update" => date('Y-m-d H:i:s'),
            ];
            $this->db->update("pengabdianberita", $dataBerita, ['id' => $this->input->post('id', true)]);

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
            "judul_error" => form_error("judul"),
            "content_error" => form_error("content"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
