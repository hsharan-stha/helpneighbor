<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chats";
    protected $fillable = [
        'id', 'sender_id', 'receiver_id', 'chat', 'created_at', 'updated_at'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
}
