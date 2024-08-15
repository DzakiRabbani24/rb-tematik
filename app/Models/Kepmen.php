<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepmen extends Model
{
    protected $table = 'kepmen';

    protected $fillable = [
        'u',
        'bu',
        'p',
        'k',
        'sk',
        'nomenklatur_urusan_kabupaten_kota',
        'kinerja',
        'indikator',
        'status',
        'tahun'
    ];

    public $timestamps = true;
}