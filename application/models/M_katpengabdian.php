<?php

class M_katpengabdian extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('katpengabdian')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('katpengabdian', ['id' => $id])->row();
    }

    public function getAllKategori()
    {
        $this->db->from('katpengabdian');
        $this->db->group_by('kategori');
        return $this->db->get()->result();
    }
    public function getAllSubKategoriByKateogri($kategori)
    {
        $this->db->from('katpengabdian');
        $this->db->where('kategori', $kategori);
        $this->db->order_by('subkategori', 'asc');
        return $this->db->get()->result();
    }
}
