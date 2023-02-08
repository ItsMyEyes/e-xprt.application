<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaTender extends Model
{
    use HasFactory;
    protected $table = 'peserta_tender';
    protected $fillable = ['id_peserta', 'id_tender', 'divisi'];

    public function tender()
    {
        return $this->hasOne(\App\Models\Tender::class, 'id', 'id_tender');
    }
    public function peserta()
    {
        return $this->hasOne(\App\Models\Peserta::class, 'id', 'id_peserta');
    }
}
