<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = "likes";
    protected $fillable = [
        'id', 'user_id', 'post_id', 'created_at', 'updated_at'
    ];
}
