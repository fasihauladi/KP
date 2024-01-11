<?php

class M_mahasiswa extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('mahasiswa')->result();
    }

    public function getDataByNpm($npm)
    {
        return $this->db->get_where('mahasiswa', ['npm' => $npm])->row();
    }

    public function getAllAngkatan()
    {
        $this->db->select('DISTINCT(angkatan) as angkatan');
        $this->db->from('mahasiswa');
        return $this->db->get()->result();
    }
}
