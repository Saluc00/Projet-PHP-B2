<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function envoie() 
    {
        if (auth()->guest()) {
            flash("Vous devez être connecté pour voir cette page.")->error();
        
            return redirect('/home');
        } 

        request()->validate([
            'message' => ['required'],
        ]);

        Message::create([
            'content' => request('message'),
            'fk_profile_id' => auth()->user()->id ,
            'fk_canal_id' => 1, 
        ]);

//        flash("Votre message a bien été publié.")->sucess();
        return back();
    }
}
