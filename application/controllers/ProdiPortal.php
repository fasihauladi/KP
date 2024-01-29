<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdiPortal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // load model
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_bidminat', 'bidminat');
        $this->load->model('M_prodiberita', 'prodiberita');
        $this->load->model('M_katpenelitian', 'katpenelitian');
        $this->load->model('M_karyapenelitian', 'karyapenelitian');
        $this->load->model('M_laboratorium', 'laboratorium');
        $this->load->model('M_dosen', 'dosen');
        $this->load->model('M_katlab', 'katlab');
        $this->load->model('M_karyalab', 'karyalab');
        $this->load->model('M_mutu', 'mutu');
        $this->load->model('M_dokumen', 'dokumen');
        $this->load->model('M_peta', 'peta');
        $this->load->model('M_labberita', 'labberita');
        $this->load->model('M_katpengabdian', 'katpengabdian');
        $this->load->model('M_karyapengabdian', 'karyapengabdian');
        $this->load->model('M_ukm', 'ukm');
        $this->load->model('M_alumni', 'alumni');
        $this->load->model('M_mahasiswa', 'mahasiswa');
        $this->load->model('M_prestasi', 'prestasi');

        $data['bidangMinatHeader'] = $this->bidminat->getAllDataByKode('tif');
        $data['labHeader'] = $this->laboratorium->getAllDataByKode('tif');
        $data['dokumenMutuHeader'] = $this->mutu->getAllDataByKategori('Mutu');
        $data['sopHeader'] = $this->mutu->getAllDataByKategori('SOP');
        $data['kategoriPenelitianHeader'] = $this->katpenelitian->getAllKategori();
        $data['kategoriPengabdianHeader'] = $this->katpengabdian->getAllKategori();
        $data['UKMHeader'] = $this->ukm->getAllData();

        $this->load->view("prodi_portal/template/header", $data);
    }

    // MENU HOME/BERANDA
    public function index()
    {
        // berita prodi
        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
        $data['kategoriKaryaPenilitian'] = $this->db->get('katpenelitian')->result();

        // prodi (visi misi dan profil)
        $data['prodiTif'] = $this->prodi->getDataByKode('tif');

        // proyek penelitian
        $data['kategoriPenelitian'] = $this->katpenelitian->getAllKategori();
        $data['limaKaryaPenelitian'] = $this->karyapenelitian->get5KaryaPenelitian();

        // bidang minat
        $data['bidangMinat'] = $this->bidminat->getAllDataByKode('tif');

        $alumni = $this->alumni->get4RandomAlumni();

        $listAlumni = ['', '', '', '', '', '', '', '', '', '', '', ''];
        $i = 0;
        foreach ($alumni as $alu) {
            $listAlumni[$i] = $alu->foto;
            $i += 1;
            $listAlumni[$i] = $alu->kesan;
            $i += 1;
            $namaMahasiswa = $this->mahasiswa->getDataByNpm($alu->npm)->nama;
            $listAlumni[$i] = $namaMahasiswa;
            $i += 1;
        }

        $data['listAlumni'] = $listAlumni;


        $this->load->view('prodi_portal/home', $data);
    }

    // MENU PRODI
    public function viewProdiTeknikInformatika($noTab)
    {
        $data['tabProfile'] = '';
        $data['tabVisiMisi'] = '';
        $data['tabDosen'] = '';

        if ($noTab == 1) {
            $data['tabProfile'] = 'active';
        } else if ($noTab == 2) {
            $data['tabVisiMisi'] = 'active';
        } else if ($noTab == 3) {
            $data['tabDosen'] = 'active';
        }

        $data['dataProdi'] = $this->prodi->getDataByKode('tif');
        $data['dataDosen'] = $this->db->order_by('nama', 'asc')->get_where('dosen', ['kodeprodi' => 'tif'])->result();

        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/prodi', $data);
    }
    public function getdosenbynip($nip)
    {
        $dosen = $this->dosen->getDataByNip($nip);

        $bidangMinat = $this->bidminat->getDataById($dosen->bidminatid);

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
            "bidang_minat" => $bidangMinat->namabidminat,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    // MENU BERITA PRODI
    public function viewBeritaProdi($id)
    {
        $data['beritaProdinya'] = $this->prodiberita->getDataById($id);
        $data['dataProdi'] = $this->prodi->getDataByKode('tif');
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/beritaprodi', $data);
    }

    // MENU BIDANG MINAT
    public function viewBdMinat($id)
    {
        $data['bidangMinatnya'] = $this->bidminat->getDataById($id);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/bidangminat', $data);
    }

    // MENU LABORATORIUM
    public function viewLaboratoriumTeknikInformatika($kodeLab)
    {
        // profile lab
        $data['profileLab'] = $this->laboratorium->getDataByKode($kodeLab);
        $data['kategoriLabnya'] = $this->katlab->getDataById($data['profileLab']->katlabid);
        $data['dosennya'] = $this->dosen->getDataByNip($data['profileLab']->nip);

        // karya lab
        $data['dataKaryaLab'] = $this->db->order_by('id', 'desc')->get_where('karyalab', ['kodeprodi' => 'tif', 'kodelab' => $kodeLab])->result();


        $data['beritaLabTerbaru'] = $this->labberita->getSeputarLabTerbaru();
        $this->load->view('prodi_portal/laboratorium', $data);
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

    // MENU DOKUMEN MUTU
    public function viewDokumenMutu($id)
    {
        $data['dokumenMutunya'] = $this->dokumen->getAllDataByMutuIdAndKodeProdi($id, 'tif');
        $data['mutunya'] = $this->mutu->getDataById($id);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/dokumenmutu', $data);
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
    public function downloadDokumenMutuProcess($id)
    {
        $message = 'gagal';

        // START TRANSACTION
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # Pengamanan jika ada multipile transaction 

        $dokumen = $this->dokumen->getDataById($id);

        // $url = base_url() . 'assets/pdfDB/dokumen/' . $dokumen->path;
        // force_download('coba.txt', 'abc');
        // force_download($url, NULL);

        $data = 'Here is some text!';
        $name = 'mytext.txt';
        force_download($name, $data);

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
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function downloadDokumenMutu($id)
    {
        // $data = 'Here is some text!';
        // $name = 'mytext.txt';
        // force_download($name, $data);

        $dokumen = $this->dokumen->getDataById($id);

        // $url = base_url() . 'assets/pdfDB/dokumen/' . $dokumen->path;
        // $url2 = '/assets/pdfDB/dokumen/' . $dokumen->path;
        // force_download('coba.txt', 'abc');
        // force_download($url, NULL);
        // force_download($url2, NULL);

        // $data = $dokumen->path;
        // $name = 'mytext.txt';
        // force_download($name, $data);

        $pth    =   file_get_contents(base_url() . 'assets/pdfDB/dokumen/' . $dokumen->path);
        $nme    =   $dokumen->namadokumen . '.pdf';
        force_download($nme, $pth);
    }

    // MENU DOKUMEN SOP
    public function viewDokumenSOP($id)
    {
        $data['dokumenSOPnya'] = $this->dokumen->getAllDataByMutuIdAndKodeProdi($id, 'tif');
        $data['sopnya'] = $this->mutu->getDataById($id);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/dokumensop', $data);
    }

    // MENU PETA PENELITIAN DOSEN
    public function viewPetaPenelitianDosen()
    {
        $data['petaPenelitianDosennya'] = $this->peta->getAllDataByKategoriAndKodeProdi('Dosen', 'tif');
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/petapenelitiandosen', $data);
    }
    public function getpetabyid($id)
    {
        $peta = $this->peta->getDataById($id);

        $data = [
            "id" => $peta->id,
            "kodeprodi" => $peta->kodeprodi,
            "kategori" => $peta->kategori,
            "namadok" => $peta->namadok,
            "deskripsi" => $peta->deskripsi,
            "berkasphp" => $peta->berkasphp,
            "create" => $peta->create,
            "update" => $peta->update,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    // MENU PETA PENELITIAN MAHASISWA
    public function viewPetaPenelitianMahasiswa()
    {
        $data['petaPenelitianMahasiswanya'] = $this->peta->getAllDataByKategoriAndKodeProdi('Mahasiswa', 'tif');
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/petapenelitianmahasiswa', $data);
    }
    // MENU KATEGORI PENELITIAN
    public function viewKategoriPenelitian($id)
    {
        $data['kategoriPenelitiannya'] = $this->katpenelitian->getDataById($id);

        $data['subKategori'] = $this->katpenelitian->getAllSubKategoriByKateogri($data['kategoriPenelitiannya']->namakatpen);

        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/kategoripenelitian', $data);
    }
    // MENU KARYA PENELITIAN
    public function viewKaryaPenelitian($id)
    {
        $data['dataKaryaPenelitian'] = $this->karyapenelitian->getDataById($id);
        $data['kategoriPenelitiannya'] = $this->katpenelitian->getDataById($data['dataKaryaPenelitian']->katpenelitianid);
        $data['dosennya'] = $this->dosen->getDataByNip($data['dataKaryaPenelitian']->nip);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/karyapenelitian', $data);
    }

    // MENU KATEGORI PENGABDIAN
    public function viewKategoriPengabdian($id)
    {
        $data['kategoriPengabdiannya'] = $this->katpengabdian->getDataById($id);

        $data['subKategori'] = $this->katpengabdian->getAllSubKategoriByKateogri($data['kategoriPengabdiannya']->kategori);

        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/kategoripengabdian', $data);
    }
    // MENU KARYA PENGABDIAN
    public function viewKaryaPengabdian($id)
    {
        $data['dataKaryaPengabdian'] = $this->karyapengabdian->getDataById($id);
        $data['kategoriPengabdiannya'] = $this->katpengabdian->getDataById($data['dataKaryaPengabdian']->katpengabdianid);
        $data['dosennya'] = $this->dosen->getDataByNip($data['dataKaryaPengabdian']->nip);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/karyapengabdian', $data);
    }

    // MENU UNIT KEGIATAN MAHASISWA
    public function viewUnitKegiatanMahasiswa($id)
    {
        $data['dataUKM'] = $this->ukm->getDataById($id);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/ukm', $data);
    }

    // MENU PRESTASI MAHASISWA
    public function viewPrestasiMahasiswa($noTab)
    {
        $data['tabRegional'] = '';
        $data['tabNasional'] = '';
        $data['tabInternasional'] = '';

        if ($noTab == 1) {
            $data['tabRegional'] = 'active';
        } else if ($noTab == 2) {
            $data['tabNasional'] = 'active';
        } else if ($noTab == 3) {
            $data['tabInternasional'] = 'active';
        }

        $data['prestasiRegional'] = $this->prestasi->getAllDataByKategori('Regional');
        $data['prestasiNasional'] = $this->prestasi->getAllDataByKategori('Nasional');
        $data['prestasiInternasional'] = $this->prestasi->getAllDataByKategori('Internasional');

        $data['beritaProdiTerbaru'] = $this->prodiberita->getSeputarProdiTerbaru();
        $this->load->view('prodi_portal/prestasi', $data);
    }
}
