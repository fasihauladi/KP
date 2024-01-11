<?php

class M_karyapenelitian extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('karyapenelitian')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('karyapenelitian', ['id' => $id])->row();
    }

    public function get5KaryaPenelitian()
    {
        $this->db->select('karyapenelitian.*');
        $this->db->select('katpenelitian.namakatpen as namakatpen');
        $this->db->select('katpenelitian.namasubkatpen as namasubkatpen');
        $this->db->select('katpenelitian.deskripsi as deskripsikatpenelitian');
        $this->db->from('karyapenelitian');
        $this->db->join('katpenelitian', 'karyapenelitian.katpenelitianid = katpenelitian.id');
        $this->db->order_by('karyapenelitian.id', 'desc');
        $this->db->limit(5);
        return $this->db->get()->result();
    }
}
