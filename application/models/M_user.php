<?php

class M_user extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('user')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row();
    }

    public function getDataByUsername($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row();
    }
}
