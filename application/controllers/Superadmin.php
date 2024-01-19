<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');

        // model
        $this->load->model('M_prodi', 'prodi');
        $this->load->model('M_mahasiswa', 'mahasiswa');
        $this->load->model('M_bidminat', 'bidminat');
        $this->load->model('M_katlab', 'katlab');
        $this->load->model('M_dosen', 'dosen');
        $this->load->model('M_laboratorium', 'laboratorium');
        $this->load->model('M_katpenelitian', 'katpenelitian');
        $this->load->model('M_katpengabdian', 'katpengabdian');
        $this->load->model('M_ukm', 'ukm');
        $this->load->model('M_mutu', 'mutu');
        $this->load->model('M_katjabatan', 'katjabatan');
        $this->load->model('M_pengurus', 'pengurus');

        $this->load->view("admin_portal/template/header");
        $this->load->view('admin_portal/template/menu');
    }

    // HOME/BERANDA
    public function index()
    {
        $this->load->view('admin_portal/super_admin/beranda_as');
    }
    // MENU USER -> ADMIN
    public function viewAdmin()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/user/tampil', $data);
    }
    public function viewTambahAdmin()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/user/tambah', $data);
    }
    public function viewEditAdmin($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/user/edit', $data);
    }
    // MENU USER -> MAHASISWA
    public function viewMahasiswa()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listAngkatan'] = $this->mahasiswa->getAllAngkatan();
        $this->load->view('admin_portal/super_admin/mahasiswa/tampil', $data);
    }
    public function viewTambahMahasiswa()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/mahasiswa/tambah', $data);
    }
    public function viewEditMahasiswa($npm)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['npm'] = $npm;
        $this->load->view('admin_portal/super_admin/mahasiswa/edit', $data);
    }
    // MENU AKADEMIK -> PRODI -> VISI MISI PRODI
    public function viewVisiMisiProdi()
    {
        $this->load->view('admin_portal/super_admin/prodi/tampil');
    }
    public function viewTambahVisiMisiProdi()
    {
        $this->load->view('admin_portal/super_admin/prodi/tambah');
    }
    public function viewEditVisiMisiProdi($kode)
    {
        $data['kode'] = $kode;
        $this->load->view('admin_portal/super_admin/prodi/edit', $data);
    }
    // MENU AKADEMIK -> PRODI -> BIDANG MINAT
    public function viewBidangMinat()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/bidminat/tampil', $data);
    }
    public function viewTambahBidangMinat()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/bidminat/tambah', $data);
    }
    public function viewEditBidangMinat($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/bidminat/edit', $data);
    }
    // MENU AKADEMIK -> PRODI -> DOSEN
    public function viewDosen()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listBidangMinat'] = $this->bidminat->getAllData();
        $this->load->view('admin_portal/super_admin/dosen/tampil', $data);
    }
    public function viewTambahDosen()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listBidangMinat'] = $this->bidminat->getAllData();
        $this->load->view('admin_portal/super_admin/dosen/tambah', $data);
    }
    public function viewEditDosen($nip)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listBidangMinat'] = $this->bidminat->getAllData();
        $data['nip'] = $nip;
        $this->load->view('admin_portal/super_admin/dosen/edit', $data);
    }
    // MENU AKADEMIK -> PRODI -> SEPUTAR PRODI
    public function viewSeputarProdi()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/prodiberita/tampil', $data);
    }
    public function viewTambahSeputarProdi()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/prodiberita/tambah', $data);
    }
    public function viewEditSeputarProdi($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/prodiberita/edit', $data);
    }
    // MENU AKADEMIK -> LABORATORIUM -> PROFILE LABORATORIUM
    public function viewProfilLaboratorium()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriLaboratorium'] = $this->katlab->getAllData();
        $this->load->view('admin_portal/super_admin/laboratorium/tampil', $data);
    }
    public function viewTambahLaboratorium()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriLaboratorium'] = $this->katlab->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $data['nextKodeLab'] = $this->laboratorium->getKodeSelanjutnya();
        $this->load->view('admin_portal/super_admin/laboratorium/tambah', $data);
    }
    public function viewEditLaboratorium($kode)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriLaboratorium'] = $this->katlab->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $data['kode'] = $kode;
        $this->load->view('admin_portal/super_admin/laboratorium/edit', $data);
    }
    // MENU AKADEMIK -> LABORATORIUM -> KATEGORI LABORATORIUM
    public function viewKategoriLaboratorium()
    {
        $this->load->view('admin_portal/super_admin/katlab/tampil');
    }
    public function viewTambahKategoriLaboratorium()
    {
        $this->load->view('admin_portal/super_admin/katlab/tambah');
    }
    public function viewEditKategoriLaboratorium($id)
    {
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/katlab/edit', $data);
    }
    // MENU AKADEMIK -> LABORATORIUM -> KARYA LABORATORIUM
    public function viewKaryaLaboratorium()
    {
        $data['listLaboratorium'] = $this->laboratorium->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/karyalab/tampil', $data);
    }
    public function viewTambahKaryaLaboratorium()
    {
        $data['listLaboratorium'] = $this->laboratorium->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/karyalab/tambah', $data);
    }
    public function viewEditKaryaLaboratorium($id)
    {
        $data['listLaboratorium'] = $this->laboratorium->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/karyalab/edit', $data);
    }
    // MENU AKADEMIK -> LABORATORIUM -> SEPUTAR LABORATORIUM
    public function viewSeputarLaboratorium()
    {
        $data['listLaboratorium'] = $this->laboratorium->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/labberita/tampil', $data);
    }
    public function viewTambahSeputarLaboratorium()
    {
        $data['listLaboratorium'] = $this->laboratorium->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/labberita/tambah', $data);
    }
    public function viewEditSeputarLaboratorium($id)
    {
        $data['listLaboratorium'] = $this->laboratorium->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/labberita/edit', $data);
    }
    // MENU AKADEMIK -> BEASISWA -> JALUR BEASISWA
    public function viewJalurBeasiswa()
    {
        $this->load->view('admin_portal/super_admin/beasiswa/tampil');
    }
    public function viewTambahJalurBeasiswa()
    {
        $this->load->view('admin_portal/super_admin/beasiswa/tambah');
    }
    public function viewEditJalurBeasiswa($id)
    {
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/beasiswa/edit', $data);
    }
    // MENU PENJAMIN MUTU -> DOKUMEN MUTU
    public function viewDokumenMutu()
    {
        $data['listKategori'] = $this->db->from('mutu')->order_by('deskripsi', 'asc')->get()->result();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/dokumen/tampil', $data);
    }
    public function viewTambahDokumenMutu()
    {
        $data['listKategori'] = $this->db->from('mutu')->order_by('deskripsi', 'asc')->get()->result();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/dokumen/tambah', $data);
    }
    public function viewEditDokumenMutu($id)
    {
        $data['listKategori'] = $this->db->from('mutu')->order_by('deskripsi', 'asc')->get()->result();
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/dokumen/edit', $data);
    }
    // MENU PENJAMIN MUTU -> SOP
    public function viewStandarOperasionalProsedur()
    {
        $this->load->view('admin_portal/super_admin/mutu/tampil');
    }
    public function viewTambahStandarOperasionalProsedur()
    {
        $this->load->view('admin_portal/super_admin/mutu/tambah');
    }
    public function viewEditStandarOperasionalProsedur($id)
    {
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/mutu/edit', $data);
    }
    // MENU PENELITIAN DAN PENGABDIAN -> PETA PENELITIAN
    public function viewPetaPenelitian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/peta/tampil', $data);
    }
    public function viewTambahPetaPenelitian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/peta/tambah', $data);
    }
    public function viewEditPetaPenelitian($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/peta/edit', $data);
    }
    // MENU PENELITIAN DAN PENGABDIAN -> KARYA PENELITIAN
    public function viewKaryaPenelitian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriPenelitian'] = $this->katpenelitian->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $this->load->view('admin_portal/super_admin/karyapenelitian/tampil', $data);
    }
    public function viewTambahKaryaPenelitian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriPenelitian'] = $this->katpenelitian->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $this->load->view('admin_portal/super_admin/karyapenelitian/tambah', $data);
    }
    public function viewEditKaryaPenelitian($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriPenelitian'] = $this->katpenelitian->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/karyapenelitian/edit', $data);
    }
    // MENU PENELITIAN DAN PENGABDIAN -> KATEGORI PENELITIAN
    public function viewKategoriPenelitian()
    {
        $this->load->view('admin_portal/super_admin/katpenelitian/tampil');
    }
    public function viewTambahKategoriPenelitian()
    {
        $this->load->view('admin_portal/super_admin/katpenelitian/tambah');
    }
    public function viewEditKategoriPenelitian($id)
    {
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/katpenelitian/edit', $data);
    }
    // MENU PENELITIAN DAN PENGABDIAN -> KARYA PENGABDIAN
    public function viewKaryaPengabdian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriPengabdian'] = $this->katpengabdian->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $this->load->view('admin_portal/super_admin/karyapengabdian/tampil', $data);
    }
    public function viewTambahKaryaPengabdian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriPengabdian'] = $this->katpengabdian->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $this->load->view('admin_portal/super_admin/karyapengabdian/tambah', $data);
    }
    public function viewEditKaryaPengabdian($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriPengabdian'] = $this->katpengabdian->getAllData();
        $data['listDosen'] = $this->dosen->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/karyapengabdian/edit', $data);
    }
    // MENU PENELITIAN DAN PENGABDIAN -> MACAM PENGABDIAN
    public function viewMacamPengabdian()
    {
        $this->load->view('admin_portal/super_admin/katpengabdian/tampil');
    }
    public function viewTambahMacamPengabdian()
    {
        $this->load->view('admin_portal/super_admin/katpengabdian/tambah');
    }
    public function viewEditMacamPengabdian($id)
    {
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/katpengabdian/edit', $data);
    }
    // MENU PENELITIAN DAN PENGABDIAN -> SEPUTAR PENGABDIAN
    public function viewSeputarPengabdian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/pengabdianberita/tampil', $data);
    }
    public function viewTambahSeputarPengabdian()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/pengabdianberita/tambah', $data);
    }
    public function viewEditSeputarPengabdian($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/pengabdianberita/edit', $data);
    }
    // MENU KEMAHASISWAAN -> UKM
    public function viewUnitKegiatanMahasiswa()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/ukm/tampil', $data);
    }
    public function viewTambahUnitKegiatanMahasiswa()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/ukm/tambah', $data);
    }
    public function viewEditUnitKegiatanMahasiswa($id)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/ukm/edit', $data);
    }
    // MENU KEMAHASISWAAN -> SEPUTAR UKM
    public function viewSeputarUKM()
    {
        $data['listUKM'] = $this->ukm->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/ukmberita/tampil', $data);
    }
    public function viewTambahSeputarUKM()
    {
        $data['listUKM'] = $this->ukm->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/ukmberita/tambah', $data);
    }
    public function viewEditSeputarUKM($id)
    {
        $data['listUKM'] = $this->ukm->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/ukmberita/edit', $data);
    }
    // MENU KEMAHASISWAAN -> PRESTASI MAHASISWA
    public function viewPrestasiMahasiswa()
    {
        $this->load->view('admin_portal/super_admin/prestasi/tampil');
    }
    public function viewTambahPrestasiMahasiswa()
    {
        $this->load->view('admin_portal/super_admin/prestasi/tambah');
    }
    public function viewEditPrestasiMahasiswa($id)
    {
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/prestasi/edit', $data);
    }
    // MENU ALUMNI DAN STAKEHOLDER -> DATA ALUMNI
    public function viewDataAlumni()
    {
        $this->load->view('admin_portal/super_admin/alumni/tampil');
    }
    public function viewTambahDataAlumni()
    {
        $this->load->view('admin_portal/super_admin/alumni/tambah');
    }
    public function viewEditDataAlumni($id)
    {
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/alumni/edit', $data);
    }
    // MENU ALUMNI DAN STAKEHOLDER -> PENGURUS
    public function viewPengurus()
    {
        $data['listDosen'] = $this->dosen->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $data['listKategoriJabatan'] = $this->katjabatan->getAllData();
        $data['listTahun'] = $this->pengurus->getAllTahunJabatan();
        $this->load->view('admin_portal/super_admin/pengurus/tampil', $data);
    }
    public function viewTambahPengurus()
    {
        $data['listDosen'] = $this->dosen->getAllData();
        $data['listKategoriJabatan'] = $this->katjabatan->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/pengurus/tambah', $data);
    }
    public function viewEditPengurus($id)
    {
        $data['listDosen'] = $this->dosen->getAllData();
        $data['listKategoriJabatan'] = $this->katjabatan->getAllData();
        $data['listProdi'] = $this->prodi->getAllData();
        $data['id'] = $id;
        $this->load->view('admin_portal/super_admin/pengurus/edit', $data);
    }
    // MENU ALUMNI DAN STAKEHOLDER -> KATEGORI JABATAN
    public function viewKategoriJabatan()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $this->load->view('admin_portal/super_admin/katjabatan/tampil', $data);
    }
    public function viewTambahKategoriJabatan()
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['nextKodeJabatan'] = $this->katjabatan->getKodeSelanjutnya();
        $this->load->view('admin_portal/super_admin/katjabatan/tambah', $data);
    }
    public function viewEditKategoriJabatan($kode)
    {
        $data['listProdi'] = $this->prodi->getAllData();
        $data['kode'] = $kode;
        $this->load->view('admin_portal/super_admin/katjabatan/edit', $data);
    }
}
