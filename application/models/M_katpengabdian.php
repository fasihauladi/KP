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
}
