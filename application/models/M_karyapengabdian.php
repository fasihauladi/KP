<?php

class M_karyapengabdian extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('karyapengabdian')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('karyapengabdian', ['id' => $id])->row();
    }
}
