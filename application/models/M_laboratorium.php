<?php

class M_laboratorium extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('laboratorium')->result();
    }

    public function getDataByKode($kode)
    {
        return $this->db->get_where('laboratorium', ['kodelab' => $kode])->row();
    }

    public function getKodeSelanjutnya()
    {
        $this->db->from('laboratorium');
        $this->db->order_by('kodelab', 'desc');
        $lastData = $this->db->get()->row();

        if ($lastData) {
            $lastKode = $lastData->kodelab;
            $lastKode = substr($lastKode, 4);
            $lastKode = (int)$lastKode;
            $lastKode++;
            $nextKode = str_pad($lastKode, 3, '0', STR_PAD_LEFT);
            return 'lab-' . $nextKode;
        } else {
            return 'lab-001';
        }
    }

    public function getAllDataByKode($kode)
    {
        return $this->db->get_where('laboratorium', ['kodeprodi' => $kode])->result();
    }
}
