<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_rumah_sakit",
        "email",
        "telepon",
        "alamat"
    ];
}
