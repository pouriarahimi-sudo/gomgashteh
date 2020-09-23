<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
        use HasFactory;
    
    protected $fillable=[
        'user_id','operation','user_agent','ip_address'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
