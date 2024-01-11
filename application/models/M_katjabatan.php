<?php

class M_katjabatan extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('katjabatan')->result();
    }

    public function getDataByKode($kode)
    {
        return $this->db->get_where('katjabatan', ['kodejabatan' => $kode])->row();
    }

    public function getKodeSelanjutnya()
    {
        $this->db->from('katjabatan');
        $this->db->order_by('kodejabatan', 'desc');
        $lastData = $this->db->get()->row();

        if ($lastData) {
            $lastKode = $lastData->kodejabatan;
            $lastKode = substr($lastKode, 3);
            $lastKode = (int)$lastKode;
            $lastKode++;
            $nextKode = str_pad($lastKode, 3, '0', STR_PAD_LEFT);
            return 'jb-' . $nextKode;
        } else {
            return 'jb-001';
        }
    }
}
