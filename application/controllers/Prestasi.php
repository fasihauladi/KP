<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_prestasi', 'prestasi');
        $this->load->model('M_mahasiswa', 'mahasiswa');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxPrestasi()
    {
        $this->load->model("datatable/S_prestasi_model", "SPmodel");
        $resuls = $this->SPmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $waktu = $this->prestasi->cekWaktuIndonesia($result->waktu);

            $mahasiswa = $this->mahasiswa->getDataByNpm($result->npm);

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->id . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/prestasi-mahasiswa/edit/' . $result->id . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->id . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];

            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $waktu . '</div>';
            $row[] =  '<div class="">' . $mahasiswa->nama . ' (' . $mahasiswa->npm . ')' . '</div>';
            $row[] =  '<div class="">' . $result->namaprestasi . '</div>';
            $row[] =  '<div class="">' . $result->kategori . '</div>';
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
    public function getprestasibyid($id)
    {
        $prestasi = $this->prestasi->getDataById($id);
        if ($prestasi) {
            $mahasiswa = $this->mahasiswa->getDataByNpm($prestasi->npm);
            $namaMahasiswa = $mahasiswa->nama;
        } else {
            $namaMahasiswa = '-';
        }

        $data = [
            "id" => $prestasi->id,
            "npm" => $prestasi->npm,
            "waktu" => $prestasi->waktu,
            "kategori" => $prestasi->kategori,
            "namaprestasi" => $prestasi->namaprestasi,
            "deskripsi" => $prestasi->deskripsi,
            "foto" => $prestasi->foto,
            "create" => $prestasi->create,
            "update" => $prestasi->update,
            "namaMahasiswa" => $namaMahasiswa,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('npm', 'zzz', 'trim|required', ["required" => "NIM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('waktu', 'zzz', 'trim|required', ["required" => "Waktu Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kategori', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namaprestasi', 'zzz', 'trim|required', ["required" => "Prestasi Tidak Boleh Kosong!"]);
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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/prestasi';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataPrestasi = [
                    // id
                    "npm" => $this->input->post('npm', true),
                    "waktu" => date('Y-m-d', strtotime($this->input->post('waktu', true))),
                    "kategori" => $this->input->post('kategori', true),
                    "namaprestasi" => $this->input->post('namaprestasi', true),
                    "deskripsi" => $this->input->post('deskripsi', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("prestasi", $dataPrestasi);
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
            "npm_error" => form_error("npm"),
            "waktu_error" => form_error("waktu"),
            "kategori_error" => form_error("kategori"),
            "namaprestasi_error" => form_error("namaprestasi"),
            "deskripsi_error" => form_error("deskripsi"),
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

        $prestasi = $this->prestasi->getDataById($this->input->post('id', true));

        if ($prestasi->foto) {
            unlink(FCPATH . "/assets/gambarDB/prestasi/" . $prestasi->foto);
        }

        $this->db->delete('prestasi', ['id' => $prestasi->id]);

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
        $this->form_validation->set_rules('npm', 'zzz', 'trim|required', ["required" => "NIM Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('waktu', 'zzz', 'trim|required', ["required" => "Waktu Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kategori', 'zzz', 'trim|required', ["required" => "Kategori Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namaprestasi', 'zzz', 'trim|required', ["required" => "Prestasi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('deskripsi', 'zzz', 'trim|required', ["required" => "Deskripsi Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == TRUE) {
            // START TRANSACTION
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

            $prestasi = $this->prestasi->getDataById($this->input->post('id', true));
            $fileName = $prestasi->foto;
            if ($_FILES['foto']['size'] != 0) {
                // Perihal foto
                $config['upload_path'] = FCPATH . '/assets/gambarDB/prestasi/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($prestasi->foto) {
                    unlink(FCPATH . "/assets/gambarDB/prestasi/" . $prestasi->foto);
                }
            }

            $dataPrestasi = [
                // id
                "npm" => $this->input->post('npm', true),
                "waktu" => date('Y-m-d', strtotime($this->input->post('waktu', true))),
                "kategori" => $this->input->post('kategori', true),
                "namaprestasi" => $this->input->post('namaprestasi', true),
                "deskripsi" => $this->input->post('deskripsi', true),
                "foto" => $fileName,
                // "create"
                "update" => date("Y-m-d H:i:s"),
            ];

            $query = $this->db->update("prestasi", $dataPrestasi, ['id' => $this->input->post('id', true)]);

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
            "npm_error" => form_error("npm"),
            "waktu_error" => form_error("waktu"),
            "kategori_error" => form_error("kategori"),
            "namaprestasi_error" => form_error("namaprestasi"),
            "deskripsi_error" => form_error("deskripsi"),
            // "foto_error" => $foto_error,
            "message" => $message,
        ];

        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
