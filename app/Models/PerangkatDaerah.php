<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDaerah extends Model
{
    use HasFactory;

    protected $table = 'perangkat_daerah'; // Pastikan nama tabel benar

    protected $fillable = ['nama']; // Pastikan sesuai dengan kolom yang ada
}
