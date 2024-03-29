<?php

class M_alumni extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('alumni')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('alumni', ['id' => $id])->row();
    }

    public function get4RandomAlumni()
    {
        $this->db->from('alumni');
        $this->db->order_by('rand()');
        $this->db->limit(4);
        return $this->db->get()->result();
    }
}
