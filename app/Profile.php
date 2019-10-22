<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'age', 'tel', 'adresse', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
