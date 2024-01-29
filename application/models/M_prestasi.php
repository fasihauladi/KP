<?php

class M_prestasi extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('prestasi')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('prestasi', ['id' => $id])->row();
    }

    public function getAllDataByKategori($kategori)
    {
        return $this->db->get_where('prestasi', ['kategori' => $kategori])->result();
    }

    public function cekWaktuIndonesia($tanggal)
    {

        if (date('D', strtotime($tanggal)) == 'Mon') {
            $hari = 'Senin';
        } elseif (date('D', strtotime($tanggal)) == 'Tue') {
            $hari = 'Selasa';
        } elseif (date('D', strtotime($tanggal)) == 'Wed') {
            $hari = 'Rabu';
        } elseif (date('D', strtotime($tanggal)) == 'Thu') {
            $hari = 'Kamis';
        } elseif (date('D', strtotime($tanggal)) == 'Fri') {
            $hari = "Jumat";
        } elseif (date('D', strtotime($tanggal)) == 'Sat') {
            $hari = 'Sabtu';
        } elseif (date('D', strtotime($tanggal)) == 'Sun') {
            $hari = 'Minggu';
        }

        if (date('n', strtotime($tanggal)) == '1') {
            $bulan = 'Januari';
        } elseif (date('n', strtotime($tanggal)) == '2') {
            $bulan = 'Februari';
        }
        if (date('n', strtotime($tanggal)) == '3') {
            $bulan = 'Maret';
        }
        if (date('n', strtotime($tanggal)) == '4') {
            $bulan = 'April';
        }
        if (date('n', strtotime($tanggal)) == '5') {
            $bulan = 'Mei';
        }
        if (date('n', strtotime($tanggal)) == '6') {
            $bulan = 'Juni';
        }
        if (date('n', strtotime($tanggal)) == '7') {
            $bulan = 'Juli';
        }
        if (date('n', strtotime($tanggal)) == '8') {
            $bulan = 'Agustus';
        }
        if (date('n', strtotime($tanggal)) == '9') {
            $bulan = 'September';
        }
        if (date('n', strtotime($tanggal)) == '10') {
            $bulan = 'Oktober';
        }
        if (date('n', strtotime($tanggal)) == '11') {
            $bulan = 'November';
        }
        if (date('n', strtotime($tanggal)) == '12') {
            $bulan = 'Desember';
        }

        $tanggalnya = date('j', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));

        return $hari . ', ' . $tanggalnya . ' ' . $bulan . ' ' . $tahun;
    }
}
