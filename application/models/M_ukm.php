<?php

class M_ukm extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('ukm')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('ukm', ['id' => $id])->row();
    }
}
