<?php

class M_prodiberita extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('prodiberita')->result();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('prodiberita', ['id' => $id])->row();
    }

    public function getAllDataByKodeProdi($kode)
    {
        return $this->db->get_where('prodiberita', ['kodeprodi' => $kode])->result();
    }

    // teknik informatika
    public function getBeritaTerbaru()
    {
        return $this->db->from('prodiberita')
            ->where('kodeprodi', 'tif')
            ->order_by('id')
            ->limit('3')->get()->result();
    }
}
