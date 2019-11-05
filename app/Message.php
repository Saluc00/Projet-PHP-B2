<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'content','date', 'fk_profile_id', 'fk_canal_id'
    ];


}