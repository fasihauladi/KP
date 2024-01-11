<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Block extends CI_Controller
{
    public function index()
    {
        $levelnya = $this->session->userdata("level_user");

        //super admin
        if ($levelnya == "SA") {
            redirect("superadmin");
        }
        // admin prodi
        elseif ($levelnya == "AP") {
            redirect("adminprodi");
        }
    }
}
