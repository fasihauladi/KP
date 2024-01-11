<?php
defined('BASEPATH') or exit('No direct script access allowed');

class S_pengurus_model extends CI_Model
{
    // beres
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    // datatable
    var $order = ['id', 'nip', 'kodejabatan', 'tahun', 'kodeprodi', 'deskripsi', 'id'];
    // beres
    private function _get_data_query()
    {
        if ($this->input->post("prodi_filter")) {
            $this->db->where('kodeprodi', $this->input->post("prodi_filter"));
        }

        if ($this->input->post("kategorijabatan_filter")) {
            $this->db->where('kodejabatan', $this->input->post("kategorijabatan_filter"));
        }

        if ($this->input->post("tahun_filter")) {
            $this->db->where('tahun', $this->input->post("tahun_filter"));
        }

        $this->db->from('pengurus');
    }
    // beres
    private function _search_order()
    {
        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('tahun', $_POST['search']['value']);
            $this->db->group_end();
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }
    // beres
    public function getDataTable()
    {
        $this->_get_data_query();
        $this->_search_order();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    // beres
    public function count_filtered_data()
    {
        $this->_get_data_query();
        $this->_search_order();
        $query = $this->db->get();
        return $query->num_rows();
    }
    // beres
    public function count_all_data()
    {
        $this->_get_data_query();
        return $this->db->count_all_results();
    }
    //akhir dari pengaturan datatable serverside
}
