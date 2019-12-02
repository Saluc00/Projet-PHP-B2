<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageEntreAmis extends Model
{
    
    protected $fillable = [
        'content', 'profil_id', 'profil_suivi_id'
    ];

}
