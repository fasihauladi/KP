<?php

class M_dokumen extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('dokumen')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('dokumen', ['id' => $id])->row();
    }

    public function getAllDataByMutuIdAndKodeProdi($mutuid, $kodeprodi)
    {
        return $this->db->get_where('dokumen', ['mutuid' => $mutuid, 'kodeprodi' => $kodeprodi])->result();
    }
}
