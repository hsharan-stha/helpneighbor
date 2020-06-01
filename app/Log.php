<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = "logs";
    protected $fillable = [
        'id','sender_id', 'receiver_id', 'message_count'
    ];
}
