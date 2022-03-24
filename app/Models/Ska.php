<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ska extends Model
{
    use HasFactory;
    protected $table = 'ska';
    protected $fillable = ['id_peserta','nama','tingkat','berlaku','klasifikasi','file'];
}
