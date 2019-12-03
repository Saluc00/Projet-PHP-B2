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
        'pseudo', 'nom', 'prenom', 'age', 'telephone', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
