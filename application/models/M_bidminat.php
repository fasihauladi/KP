<?php

class M_bidminat extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('bidminat')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('bidminat', ['id' => $id])->row();
    }

    public function getAllDataByKode($kode)
    {
        return $this->db->get_where('bidminat', ['kodeprodi' => $kode])->result();
    }
}
