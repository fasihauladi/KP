<?php

class M_pengabdianberita extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('pengabdianberita')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('pengabdianberita', ['id' => $id])->row();
    }
}
