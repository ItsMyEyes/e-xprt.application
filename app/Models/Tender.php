<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;
    protected $fillable = ['nama_tender','nama_perusahaan','divis_count','status'];

    public function getColour()
    {
        if ($this->status == 'terbuat') {
            return 'primary';
        } else if ($this->status == 'progress') {
            return 'warning';
        } else if ($this->status == 'selesai') {
            return 'success';
        }
    }

    public function peserta()
    {
        return $this->hasMany(\App\Models\PesertaTender::class,'id_tender','id');
    }

    public function countPeserta()
    {
        return count($this->peserta);
    }
}
