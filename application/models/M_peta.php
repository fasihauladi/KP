<?php

class M_peta extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('peta')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('peta', ['id' => $id])->row();
    }
}
