<?php

class M_katpenelitian extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('katpenelitian')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('katpenelitian', ['id' => $id])->row();
    }

    public function getAllKategori()
    {
        $this->db->from('katpenelitian');
        $this->db->group_by('namakatpen');
        return $this->db->get()->result();
    }
    public function getAllSubKategoriByKateogri($kategori)
    {
        $this->db->from('katpenelitian');
        $this->db->where('namakatpen', $kategori);
        $this->db->order_by('namasubkatpen', 'asc');
        return $this->db->get()->result();
    }
}
