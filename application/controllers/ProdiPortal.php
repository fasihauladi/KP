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

        $data['bidangMinatHeader'] = $this->bidminat->getAllDataByKode('tif');
        $data['labHeader'] = $this->laboratorium->getAllDataByKode('tif');
        $data['dokumenMutuHeader'] = $this->mutu->getAllDataByKategori('Mutu');
        $data['sopHeader'] = $this->mutu->getAllDataByKategori('SOP');

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

        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
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
        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
        $this->load->view('prodi_portal/beritaprodi', $data);
    }

    // MENU KARYAPENELITIAN
    public function viewKaryaPenelitian($id)
    {
        $data['dataKaryaPenelitian'] = $this->karyapenelitian->getDataById($id);
        $data['kategoriPenelitiannya'] = $this->katpenelitian->getDataById($data['dataKaryaPenelitian']->katpenelitianid);
        $data['dosennya'] = $this->dosen->getDataByNip($data['dataKaryaPenelitian']->nip);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
        $this->load->view('prodi_portal/karyapenelitian', $data);
    }

    // MENU BIDANG MINAT
    public function viewBdMinat($id)
    {
        $data['bidangMinatnya'] = $this->bidminat->getDataById($id);
        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
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


        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
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
        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
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
        $data['beritaProdiTerbaru'] = $this->prodiberita->getBeritaTerbaru();
        $this->load->view('prodi_portal/dokumensop', $data);
    }
}
