<?php

class M_labberita extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('labberita')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('labberita', ['id' => $id])->row();
    }
}
