<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPasting extends Model
{
    protected $table = 'data_pasting';
    protected $allowedFields = ['kode_rak', 'gedung_asal', 'gedung_tujuan'];
}