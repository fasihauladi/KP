<?php

class M_dosen extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('dosen')->result();
    }

    public function getAllDataByKode($kode)
    {
        return $this->db->get_where('dosen', ['kodeprodi' => $kode])->result();
    }

    public function getDataByNip($nip)
    {
        return $this->db->get_where('dosen', ['nip' => $nip])->row();
    }
}
