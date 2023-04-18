<?php

namespace App\Controllers;

use App\Models\ModelPasting;

class Pasting extends BaseController
{


    public function input()
    {
        return view('content/input_pasting');
    }

    public function info()
    {
        return view('cek');
    }

    protected $db;
    protected $ModelPasting;
    public function __construct()
    {
        $this->ModelPasting = new ModelPasting();
        $this->db = db_connect();
    }

    public function summary()
    {
        $pasting = $this->ModelPasting->findAll();

        $data = [
            'title' => 'Summary',
            'pasting' => $pasting
        ];


        return view('content/summary', $data);
    }


    public function save()
    {
        $kode_rak = $this->request->getVar('kode_rak');
        $gedung_asal = $this->request->getVar('gedung_asal');
        $gedung_tujuan = $this->request->getVar('gedung_tujuan');

        foreach ($kode_rak as $rak) {
            if ($rak !== 0 && $rak !== "") {
                $data[] = array(
                    'kode_rak' => $rak,
                    'gedung_asal' => $gedung_asal,
                    'gedung_tujuan' => $gedung_tujuan
                );
            }
        }
        $this->ModelPasting->insertBatch($data);
        return redirect()->to('/input_pasting');
    }
}
