<?php

class M_karyalab extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('karyalab')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('karyalab', ['id' => $id])->row();
    }
}
