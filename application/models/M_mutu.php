<?php

class M_mutu extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('mutu')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('mutu', ['id' => $id])->row();
    }

    public function getAllDataByKategori($kategori)
    {
        return $this->db->get_where('mutu', ['kategori' => $kategori])->result();
    }
}
