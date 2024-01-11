<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laboratorium extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_laboratorium', 'laboratorium');
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_katlab', 'katlab');
        $this->load->model('M_dosen', 'dosen');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    public function readAjaxLaboratorium()
    {
        $this->load->model("datatable/S_laboratorium_model", "SLmodel");
        $resuls = $this->SLmodel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {
            $no++;

            $prodi = $this->prodi->getDataByKode($result->kodeprodi)->namaprodi;

            $kategoriLab = $this->katlab->getDataById($result->katlabid)->kategori;

            $dosen = $this->dosen->getDataByNip($result->nip)->nama;

            $tombolAksi = '
                <button class="btn btn-xs btn-info btn-flat" onclick="bukaModalDetail(' . "'" . $result->kodelab . "'" . ')"><i class="fa fa-info-circle"></i></button>
                <a href="' . base_url() . 'superadmin/profil-laboratorium/edit/' . $result->kodelab . '"><button class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button></a>
                <button class="btn btn-xs btn-danger btn-flat" onclick="bukaModalHapus(' . "'" . $result->kodelab . "'" . ')"><i class="fa fa-trash"></i></button>
            ';

            $row = [];
            $row[] =  '<div class="">' . $no . '</div>';
            $row[] =  '<div class="">' . $result->kodelab . '</div>';
            $row[] =  '<div class="">' . $result->namalab . '</div>';
            $row[] =  '<div class="">' . $dosen . '</div>';
            $row[] =  '<div class="">' . $kategoriLab . '</div>';
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
    public function getlaboratoriumbykode($kode)
    {
        $lab = $this->laboratorium->getDataByKode($kode);

        $data = [
            "kodelab" => $lab->kodelab,
            "nip" => $lab->nip,
            "kodeprodi" => $lab->kodeprodi,
            "katlabid" => $lab->katlabid,
            "namalab" => $lab->namalab,
            "profile" => $lab->profile,
            "foto" => $lab->foto,
            "create" => $lab->create,
            "update" => $lab->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function tambahDataProcess()
    {
        $message = 'gagal';
        $foto_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('katlabid', 'zzz', 'trim|required', ["required" => "Kategori Lab. Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "Dosen Penanggung Jawab Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namalab', 'zzz', 'trim|required', ["required" => "Nama Lab. Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('profile', 'zzz', 'trim|required', ["required" => "Profil Lab. Tidak Boleh Kosong!"]);

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
                $config['upload_path'] = FCPATH . '/assets/gambarDB/laboratorium/';
                $config['file_name'] = date("YmdHis") . uniqid();
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '10000';
                $config['overwrite']     = TRUE;
                $path_parts = pathinfo($_FILES["foto"]["name"]);
                $extension = $path_parts['extension'];
                $fileName = $config['file_name'] . "." . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $dataLab = [
                    "kodelab" => $this->input->post('kodelab', true),
                    "nip" => $this->input->post('nip', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "katlabid" => $this->input->post('katlabid', true),
                    "namalab" => $this->input->post('namalab', true),
                    "profile" => $this->input->post('profile', true),
                    "foto" => $fileName,
                    "create" => date("Y-m-d H:i:s"),
                    // "update"
                ];

                $query = $this->db->insert("laboratorium", $dataLab);
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
            "katlabid_error" => form_error("katlabid"),
            "nip_error" => form_error("nip"),
            "namalab_error" => form_error("namalab"),
            "foto_error" => $foto_error,
            "profile_error" => form_error("profile"),
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

        $lab = $this->laboratorium->getDataByKode($this->input->post('kodelab', true));

        if ($lab->foto) {
            unlink(FCPATH . "/assets/gambarDB/laboratorium/" . $lab->foto);
        }

        $this->db->delete('laboratorium', ['kodelab' => $lab->kodelab]);

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
        $kodelab_error = '';

        // konfigurasi form validasi
        $this->form_validation->set_rules('kodelab', 'zzz', 'trim|required', ["required" => "Kode Lab. Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('kodeprodi', 'zzz', 'trim|required', ["required" => "Prodi Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('katlabid', 'zzz', 'trim|required', ["required" => "Kategori Lab. Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('nip', 'zzz', 'trim|required', ["required" => "Dosen Penanggung Jawab Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('namalab', 'zzz', 'trim|required', ["required" => "Nama Lab. Tidak Boleh Kosong!"]);
        $this->form_validation->set_rules('profile', 'zzz', 'trim|required', ["required" => "Profil Lab. Tidak Boleh Kosong!"]);

        if ($this->form_validation->run() == FALSE) {
            $kodelab_error = form_error("kodelab");
            if ($this->input->post('kodelab', true)) {
                $cekKodeLab = $this->laboratorium->getDataByKode($this->input->post('kodelab', true));
                if ($cekKodeLab and $cekKodeLab->kodelab != $this->input->post('kodelab_awal', true)) {
                    $kodelab_error = '<p>Kode Lab. sudah ada (Tidak Boleh Sama)</p>';
                }
            }
        } else {
            $kodelab_error = form_error("kodelab");
            if ($this->input->post('kodelab', true)) {
                $cekKodeLab = $this->laboratorium->getDataByKode($this->input->post('kodelab', true));
                if ($cekKodeLab and $cekKodeLab->kodelab != $this->input->post('kodelab_awal', true)) {
                    $kodelab_error = '<p>Kode Lab. sudah ada (Tidak Boleh Sama)</p>';
                }
            }

            if ($kodelab_error == '') {

                // START TRANSACTION
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction

                $laboratorium = $this->laboratorium->getDataByKode($this->input->post('kodelab_awal', true));
                $fileName = $laboratorium->foto;
                if ($_FILES['foto']['size'] != 0) {
                    // Perihal foto
                    $config['upload_path'] = FCPATH . '/assets/gambarDB/laboratorium/';
                    $config['file_name'] = date("YmdHis") . uniqid();
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size']     = '10000';
                    $config['overwrite']     = TRUE;
                    $path_parts = pathinfo($_FILES["foto"]["name"]);
                    $extension = $path_parts['extension'];
                    $fileName = $config['file_name'] . "." . $extension;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($laboratorium->foto) {
                        unlink(FCPATH . "/assets/gambarDB/laboratorium/" . $laboratorium->foto);
                    }
                }

                $dataLab = [
                    "kodelab" => $this->input->post('kodelab', true),
                    "nip" => $this->input->post('nip', true),
                    "kodeprodi" => $this->input->post('kodeprodi', true),
                    "katlabid" => $this->input->post('katlabid', true),
                    "namalab" => $this->input->post('namalab', true),
                    "profile" => $this->input->post('profile', true),
                    "foto" => $fileName,
                    // "create"
                    "update" => date("Y-m-d H:i:s"),
                ];

                $query = $this->db->update("laboratorium", $dataLab, ['kodelab' => $this->input->post('kodelab_awal', true)]);

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
            "kodelab_error" => $kodelab_error,
            "kodeprodi_error" => form_error("kodeprodi"),
            "katlabid_error" => form_error("katlabid"),
            "nip_error" => form_error("nip"),
            "namalab_error" => form_error("namalab"),
            // "foto_error" => $foto_error,
            "profile_error" => form_error("profile"),
            "message" => $message,
        ];
        $data['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
