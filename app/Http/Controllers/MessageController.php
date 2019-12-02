<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\MessageEntreAmis;
use Illuminate\Support\Facades\DB;

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

    public function messageEntreAmisEnvoie($id)
    {
        $test1 = DB::select('select * from message_entre_amis where profil_id = ? and profil_suivi_id = ?', [auth()->user()->id,  $id]);
        $test2 = DB::select('select * from message_entre_amis where profil_suivi_id = ? and profil_id = ?', [auth()->user()->id,  $id]);

        if (!empty($test1) && empty($test2))
        {
            MessageEntreAmis::create([
                'content' => request('message'),
                'profil_id' => auth()->user()->id,
                'profil_suivi_id' => $id,
            ]);

            return back();            
        }
        elseif (!empty($test2) && empty($test1))
        {
            MessageEntreAmis::create([
                'content' => request('message'),
                'profil_id' => $id,
                'profil_suivi_id' => auth()->user()->id,
            ]);
            
            return back();
        }
        else
        {
            MessageEntreAmis::create([
                'content' => request('message'),
                'profil_id' => auth()->user()->id,
                'profil_suivi_id' => $id,
            ]);

            return back();
        }

    }

    public function messageEntreAmis($id) 
    {   
        $messages = DB::select('select * from message_entre_amis where profil_id = ? and profil_suivi_id = ?', [auth()->user()->id,  $id]);
        if (empty($messages))
        {
            $messages = DB::select('select * from message_entre_amis where profil_suivi_id = ? and profil_id = ?', [auth()->user()->id,  $id]);
        }
        return view('message', [
            'message' =>  $messages,
            'id' => $id,

        ]);
    }
}