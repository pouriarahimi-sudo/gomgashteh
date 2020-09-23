<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_answer extends Model
{
        use HasFactory;

    protected $fillable=[
        'announcement_id','ticket_id','message','pictures','sender_id','receiver_id'
    ];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }

//    public function receiver(){
//        return $this->belongsTo(User::class,'receiver_id');
//    }

}
