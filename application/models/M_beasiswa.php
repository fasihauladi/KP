<?php

class M_beasiswa extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('beasiswa')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('beasiswa', ['id' => $id])->row();
    }
}
