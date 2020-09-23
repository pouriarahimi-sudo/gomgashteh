<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
        use HasFactory;

    protected $fillable=[
        'announcement_id','sender_id','message','pictures','sender_confirm','receiver_confirm'
    ];

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
