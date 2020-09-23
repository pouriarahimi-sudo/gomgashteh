<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable=['first_name','last_name','national_code','phone_num','status','father_name','birthday','gender','tell','marital_status','email','province_id','city_id','address','postal_code','admin_pic','financial_situation','access_type'];

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
