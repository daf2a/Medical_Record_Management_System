<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekam extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'pasien',
            'dokter',
            'kondisi',
            'suhu',
            'picture',
        ];
    // Di model Rekam.php
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}

