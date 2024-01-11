<?php

class M_pengurus extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('pengurus')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('pengurus', ['id' => $id])->row();
    }

    public function getAllTahunJabatan()
    {
        $this->db->from('pengurus');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'asc');
        return $this->db->get()->result();
    }
}
