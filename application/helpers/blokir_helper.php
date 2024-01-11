<?php

// cek login
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata("username_user")) {
        $ci->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
        Mohon untuk login dulu.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');
        redirect("tiflog");
    } else {
        $level = $ci->session->userdata("level_user");
        $url = $ci->uri->segment(1);
        if ($level == "SA") {
            if (!in_array($url, [
                "superadmin", "alumni", "beasiswa",
                "bidminat", "dokumen", "dosen",
                "karyalab", "karyapenelitian", "karyapengabdian",
                "katjabatan", "katlab", "katpenelitian",
                "katpengabdian", "labberita", "laboratorium",
                "mahasiswa", "mutu", "pengabdianberita",
                "pengurus", "peta", "prestasi",
                "prodi", "prodiberita", "ukm",
                "ukmberita", "user"
            ])) {
                redirect("block");
            }
        }
        if ($level == "AP") {
            if (!in_array($url, [
                "",
            ])) {
                redirect("block");
            }
        }
    }
}

if (!function_exists('active_link')) {
    function activate_menu($menu)
    {
        $ci = get_instance();
        $segment1 = $ci->uri->segment(1);

        if ($segment1 == 'superadmin') {
            $segment2 = $ci->uri->segment(2);
            $arr = [];

            // MENU UTAMA : USER
            if ($menu == 'user') {
                $arr = ['admin', 'mahasiswa'];
            }

            // MENU UTAMA : AKADEMIK : PRODI
            elseif ($menu == 'akademik' or $menu = 'prodi') {
                $arr = ['visi-misi-prodi'];
            }


            //pengecekan akhir
            if (in_array($segment2, $arr)) {
                $active = 'active';
            } else {
                $active = '';
            }
            // khusus beranda
            // if ($menu == 'beranda' and !$segment2) {
            //     $active = 'active';
            // }

            return $active;
        }
    }
}
