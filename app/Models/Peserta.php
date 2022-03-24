<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama','ktp','tempat_lahir','tanggal_lahir'
    ];

    public function ijazah()
    {
        return $this->hasMany(\App\Models\Ijazah::class, 'id_peserta','id');
    }

    public function ska()
    {
        return $this->hasMany(\App\Models\Ska::class, 'id_peserta','id');
    }

    public function comment()
    {
        return $this->hasMany(\App\Models\Notification::class, 'id_peserta','id');
    }

    public function notification()
    {
        return $this->hasMany(\App\Models\Notification::class, 'id_peserta','id');
    }

    public function tender()
    {
        return $this->hasMany(\App\Models\PesertaTender::class,'id_peserta','id');
    }

    public function getCommentar($tender)
    {
        if (count($this->comment) > 0) {
            foreach ($this->comment as $key => $value) {
                if ($value->id_tender == $tender && $value->status == 'not_clear') {
                    return $value->text;
                    // dd($value);
                } else {
                    return null;
                }
            }
        }

        return null;
    }

    public function getJabatan($tender)
    {
        $check = PesertaTender::where([
            'id_peserta' => $this->id,
            'id_tender' => $tender
        ])->first();
        return $check->divisi;
    }

    public function checkChooseOnTender($tender)
    {
        $tender = Tender::find($tender);

        if (empty($tender)) return false;

        $check = PesertaTender::where([
            'id_peserta' => $this->id,
            'id_tender' => $tender->id
        ])->first();

        if (empty($check) || is_null($check)) return false;
        return true;
    }

    public function countIjazah()
    {
        return count($this->ijazah);
    }

    public function countSka()
    {
        return count($this->ska);
    }
    
    public function checkStatus()
    {
        foreach ($this->notification as $key => $value) {
            if ($value->status == 'not_clear') {
                return false;
            }
        }
        return true;
    }

    public function getNotif()
    {   
        $data = [];
        foreach ($this->notification as $key => $value) {
            if ($value->status == 'not_clear') {
                $data[] = $value;
            }
        }
        return $data;
    }

    public function checkAvailableDelete()
    {
        if (count($this->tender) < 1) {
            return true;
        }

        return false;
    }

    public function sendWebNotification($body, $type = 'hc')
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        if ($type == 'hc') {
            $FcmToken = User::whereNotNull('device_key')->where('role','hc')->pluck('device_key')->all();
        }
        if ($type == 'pemasaran') {
            $FcmToken = User::whereNotNull('device_key')->where('role','pemasaran')->pluck('device_key')->all();
        }
        // return $FcmToken;
          
        $serverKey = 'AAAAmLnXpDU:APA91bG8kWF7FNqwOiJu60EnYZbMzOl5EGK3OaX-NUsgvuWAvt1rqYfCYBh1Uct-OhIAjLPCVgy0kWgFXo1RBmVhJRyqbGKQ08rbdr1yrylPBEng0yhewDYWdrpoB40gH0XKX3kfY4Nz';
  
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => "Notification Kundiges",
                "body" => $body,  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
    }
}
