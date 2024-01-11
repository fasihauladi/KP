<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'prodiPortal';
//portal akademik
$route['berita-prodi/(:num)'] = 'prodiPortal/viewBeritaProdi/$1';
$route['prodi-teknik-informatika/(:num)'] = 'prodiPortal/viewProdiTeknikInformatika/$1';
$route['karya-penelitian/(:num)'] = 'prodiPortal/viewKaryaPenelitian/$1';
$route['bidang-minat/(:num)'] = 'prodiPortal/viewBdMinat/$1';
$route['laboratorium-teknik-informatika/(:any)'] = 'prodiPortal/viewLaboratoriumTeknikInformatika/$1';
$route['dokumen-mutu/(:num)'] = 'prodiPortal/viewDokumenMutu/$1';
$route['download-dokumen-mutu/(:num)'] = 'prodiPortal/downloadDokumenMutu/$1';



// SUPER ADMIN
// super admin - admin
$route['superadmin/admin'] = 'superadmin/viewAdmin';
$route['superadmin/admin/tambah'] = 'superadmin/viewTambahAdmin';
$route['superadmin/admin/edit/(:num)'] = 'superadmin/viewEditAdmin/$1';
// super admin - mahasiswwa
$route['superadmin/mahasiswa'] = 'superadmin/viewMahasiswa';
$route['superadmin/mahasiswa/tambah'] = 'superadmin/viewTambahMahasiswa';
$route['superadmin/mahasiswa/edit/(:num)'] = 'superadmin/viewEditMahasiswa/$1';
// super admin - visi misi prodi
$route['superadmin/visi-misi-prodi'] = 'superadmin/viewVisiMisiProdi';
$route['superadmin/visi-misi-prodi/tambah'] = 'superadmin/viewTambahVisiMisiProdi';
$route['superadmin/visi-misi-prodi/edit/(:any)'] = 'superadmin/viewEditVisiMisiProdi/$1';
// super admin - bidang minat
$route['superadmin/bidang-minat'] = 'superadmin/viewBidangMinat';
$route['superadmin/bidang-minat/tambah'] = 'superadmin/viewTambahBidangMinat';
$route['superadmin/bidang-minat/edit/(:num)'] = 'superadmin/viewEditBidangMinat/$1';
// super admin - dosen
$route['superadmin/dosen'] = 'superadmin/viewDosen';
$route['superadmin/dosen/tambah'] = 'superadmin/viewTambahDosen';
$route['superadmin/dosen/edit/(:any)'] = 'superadmin/viewEditDosen/$1';
// super admin - seputar prodi
$route['superadmin/seputar-prodi'] = 'superadmin/viewSeputarProdi';
$route['superadmin/seputar-prodi/tambah'] = 'superadmin/viewTambahSeputarProdi';
$route['superadmin/seputar-prodi/edit/(:num)'] = 'superadmin/viewEditSeputarProdi/$1';
// super admin - profil Laboratorium
$route['superadmin/profil-laboratorium'] = 'superadmin/viewProfilLaboratorium';
$route['superadmin/profil-laboratorium/tambah'] = 'superadmin/viewTambahLaboratorium';
$route['superadmin/profil-laboratorium/edit/(:any)'] = 'superadmin/viewEditLaboratorium/$1';
// super admin - kategori laboratorium
$route['superadmin/kategori-laboratorium'] = 'superadmin/viewKategoriLaboratorium';
$route['superadmin/kategori-laboratorium/tambah'] = 'superadmin/viewTambahKategoriLaboratorium';
$route['superadmin/kategori-laboratorium/edit/(:num)'] = 'superadmin/viewEditKategoriLaboratorium/$1';
// super admin - karya laboratorium
$route['superadmin/karya-laboratorium'] = 'superadmin/viewKaryaLaboratorium';
$route['superadmin/karya-laboratorium/tambah'] = 'superadmin/viewTambahKaryaLaboratorium';
$route['superadmin/karya-laboratorium/edit/(:num)'] = 'superadmin/viewEditKaryaLaboratorium/$1';
// super admin - seputar laboratorium
$route['superadmin/seputar-laboratorium'] = 'superadmin/viewSeputarLaboratorium';
$route['superadmin/seputar-laboratorium/tambah'] = 'superadmin/viewTambahSeputarLaboratorium';
$route['superadmin/seputar-laboratorium/edit/(:num)'] = 'superadmin/viewEditSeputarLaboratorium/$1';
// super admin - jalur beasiswa
$route['superadmin/jalur-beasiswa'] = 'superadmin/viewJalurBeasiswa';
$route['superadmin/jalur-beasiswa/tambah'] = 'superadmin/viewTambahJalurBeasiswa';
$route['superadmin/jalur-beasiswa/edit/(:num)'] = 'superadmin/viewEditJalurBeasiswa/$1';
// super admin - dokumen mutu
$route['superadmin/dokumen-mutu'] = 'superadmin/viewDokumenMutu';
$route['superadmin/dokumen-mutu/tambah'] = 'superadmin/viewTambahDokumenMutu';
$route['superadmin/dokumen-mutu/edit/(:num)'] = 'superadmin/viewEditDokumenMutu/$1';
// super admin - SOP
$route['superadmin/standar-operasional-prosedur'] = 'superadmin/viewStandarOperasionalProsedur';
$route['superadmin/standar-operasional-prosedur/tambah'] = 'superadmin/viewTambahStandarOperasionalProsedur';
$route['superadmin/standar-operasional-prosedur/edit/(:num)'] = 'superadmin/viewEditStandarOperasionalProsedur/$1';
// super admin - peta penelitian
$route['superadmin/peta-penelitian'] = 'superadmin/viewPetaPenelitian';
$route['superadmin/peta-penelitian/tambah'] = 'superadmin/viewTambahPetaPenelitian';
$route['superadmin/peta-penelitian/edit/(:num)'] = 'superadmin/viewEditPetaPenelitian/$1';
// super admin - karya penelitian
$route['superadmin/karya-penelitian'] = 'superadmin/viewKaryaPenelitian';
$route['superadmin/karya-penelitian/tambah'] = 'superadmin/viewTambahKaryaPenelitian';
$route['superadmin/karya-penelitian/edit/(:num)'] = 'superadmin/viewEditKaryaPenelitian/$1';
// super admin - kategori penelitian
$route['superadmin/kategori-penelitian'] = 'superadmin/viewKategoriPenelitian';
$route['superadmin/kategori-penelitian/tambah'] = 'superadmin/viewTambahKategoriPenelitian';
$route['superadmin/kategori-penelitian/edit/(:num)'] = 'superadmin/viewEditKategoriPenelitian/$1';
// super admin - karya pengabdian
$route['superadmin/karya-pengabdian'] = 'superadmin/viewKaryaPengabdian';
$route['superadmin/karya-pengabdian/tambah'] = 'superadmin/viewTambahKaryaPengabdian';
$route['superadmin/karya-pengabdian/edit/(:num)'] = 'superadmin/viewEditKaryaPengabdian/$1';
// super admin - macam pengabdian
$route['superadmin/macam-pengabdian'] = 'superadmin/viewMacamPengabdian';
$route['superadmin/macam-pengabdian/tambah'] = 'superadmin/viewTambahMacamPengabdian';
$route['superadmin/macam-pengabdian/edit/(:num)'] = 'superadmin/viewEditMacamPengabdian/$1';
// super admin - seputar pengabdian
$route['superadmin/seputar-pengabdian'] = 'superadmin/viewSeputarPengabdian';
$route['superadmin/seputar-pengabdian/tambah'] = 'superadmin/viewTambahSeputarPengabdian';
$route['superadmin/seputar-pengabdian/edit/(:num)'] = 'superadmin/viewEditSeputarPengabdian/$1';
// super admin - UKM
$route['superadmin/unit-kegiatan-mahasiswa'] = 'superadmin/viewUnitKegiatanMahasiswa';
$route['superadmin/unit-kegiatan-mahasiswa/tambah'] = 'superadmin/viewTambahUnitKegiatanMahasiswa';
$route['superadmin/unit-kegiatan-mahasiswa/edit/(:num)'] = 'superadmin/viewEditUnitKegiatanMahasiswa/$1';
// super admin - seputar ukm
$route['superadmin/seputar-ukm'] = 'superadmin/viewSeputarUKM';
$route['superadmin/seputar-ukm/tambah'] = 'superadmin/viewTambahSeputarUKM';
$route['superadmin/seputar-ukm/edit/(:num)'] = 'superadmin/viewEditSeputarUKM/$1';
// super admin - prestasi mahasiswa
$route['superadmin/prestasi-mahasiswa'] = 'superadmin/viewPrestasiMahasiswa';
$route['superadmin/prestasi-mahasiswa/tambah'] = 'superadmin/viewTambahPrestasiMahasiswa';
$route['superadmin/prestasi-mahasiswa/edit/(:num)'] = 'superadmin/viewEditPrestasiMahasiswa/$1';
// super admin - data alumni
$route['superadmin/data-alumni'] = 'superadmin/viewDataAlumni';
$route['superadmin/data-alumni/tambah'] = 'superadmin/viewTambahDataAlumni';
$route['superadmin/data-alumni/edit/(:num)'] = 'superadmin/viewEditDataAlumni/$1';
// super admin - pengurus (ONGOING)
$route['superadmin/pengurus'] = 'superadmin/viewPengurus';
$route['superadmin/pengurus/tambah'] = 'superadmin/viewTambahPengurus';
$route['superadmin/pengurus/edit/(:num)'] = 'superadmin/viewEditPengurus/$1';
// super admin - kategori jabatan
$route['superadmin/kategori-jabatan'] = 'superadmin/viewKategoriJabatan';
$route['superadmin/kategori-jabatan/tambah'] = 'superadmin/viewTambahKategoriJabatan';
$route['superadmin/kategori-jabatan/edit/(:any)'] = 'superadmin/viewEditKategoriJabatan/$1';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
