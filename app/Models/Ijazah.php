<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    use HasFactory;
    protected $table = 'ijazah';
    protected $fillable = ['id_peserta','nama','file','tahun_lulus','tingkat'];
}
