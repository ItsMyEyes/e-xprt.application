<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $fillable = ['id_peserta','text','id_tender','status'];

    public function tender()
    {
        return $this->hasOne(\App\Models\Tender::class,'id','id_tender');
    }

    public function user()
    {
        return $this->hasOne(\App\Models\User::class,'id','id_peserta');
    }
}
