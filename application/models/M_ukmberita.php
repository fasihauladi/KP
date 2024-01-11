<?php

class M_ukmberita extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('ukmberita')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('ukmberita', ['id' => $id])->row();
    }
}
