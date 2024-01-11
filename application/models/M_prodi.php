<?php

class M_prodi extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('prodi')->result();
    }

    public function getDataByKode($kode)
    {
        return $this->db->get_where('prodi', ['kodeprodi' => $kode])->row();
    }
}
