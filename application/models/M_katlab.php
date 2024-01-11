<?php

class M_katlab extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('katlab')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('katlab', ['id' => $id])->row();
    }
}
