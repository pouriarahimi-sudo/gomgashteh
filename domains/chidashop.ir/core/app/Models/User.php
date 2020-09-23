<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'phone_num','national_code', 'gender', 'tell', 'email',
        'province_id', 'city_id','address', 'postal_code', 'user_pic', 'financial_situation', 'user_status'
    ];

    public function notice(){
        return $this->hasMany(Notice::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
