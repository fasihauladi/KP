<?php

class M_labberita extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('labberita')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('labberita', ['id' => $id])->row();
    }

    public function getSeputarLabTerbaru()
    {
        $berita = $this->db->from('labberita')->where('kodeprodi', 'tif')->order_by('tanggal', 'desc')->limit('4')->get()->result();
        $beritaTerbaru = '<h3 class="judul"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Seputar Laboratorium Terbaru</h3>';
        foreach ($berita as $ber) {
            $image = base_url() . 'assets/gambarDB/berita/lab/' . $ber->thumbnail;
            $url = base_url() . 'berita-laboratorium/' . $ber->id;
            $beritaTerbaru = $beritaTerbaru . '
            <div class="event_news">
                <div class="event_single_item fix">
                    <div class="event_news_img floatleft">
                        <img src="' . $image . '" alt="">
                    </div>
                    <div class="event_news_text">
                        <a href="' . $url . '">
                            <h4>' . $ber->judulberita . '</h4>
                        </a>
                        <h6 style="padding-top:7px;">' . $this->cekWaktuIndonesia($ber->tanggal) . '</h6>
                        ' . substr($ber->content, 0, 75) . ' ...
                    </div>
                </div>
            </div>';
        }
        return $beritaTerbaru;
    }

    private function cekWaktuIndonesia($tanggal)
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
