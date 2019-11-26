<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    protected $fillable = [
        'titre', 'estPublic'
    ];

    public function message()
    {
        return $this->hasMany(Message::class)->latest();
    }
}
