<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepmen extends Model
{
    protected $table = 'kepmen';

    protected $fillable = [
        'U',
        'BU',
        'P',
        'K',
        'SK',
        'nomenklatur_urusan_kabupaten_kota',
        'indikator',
        'status',
        'tahun'
    ];

    public $timestamps = false;
}