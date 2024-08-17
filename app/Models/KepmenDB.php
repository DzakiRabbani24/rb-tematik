<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepmenDb extends Model
{
    protected $table = 'kepmen_db';
    public $timestamps = false;
    protected $fillable = ['tahun', 'status'];
}
