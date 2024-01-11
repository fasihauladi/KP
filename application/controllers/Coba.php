<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->load->view("coba");
    }

    public function readAjaxCoba()
    {
        $this->load->model("C_coba_model", "CCModel");
        $resuls = $this->CCModel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($resuls as $result) {

            $warna = '';

            $row = [];
            $row[] =  '<div class="row mx-2' . $warna . '">' . $result->nama . '</div>';
            $row[] =  '<div class="row mx-2' . $warna . '">' . $result->username . '</div>';
            $row[] =  '<div class="row mx-2' . $warna . '">' . $result->level . '</div>';

            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->CCModel->count_all_data(),
            "recordsFiltered" => $this->CCModel->count_filtered_data(),
            "data" => $data
        ];
        $output['token'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
}
