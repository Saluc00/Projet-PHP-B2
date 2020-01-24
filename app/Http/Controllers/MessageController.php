<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\MessageEntreAmis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
            'fk_profile_id' => auth()->user()->id,
            'fk_canal_id' => 1,
        ]);

        //  flash("Votre message a bien été publié.")->sucess();
        return back();
    }

    public function messageEntreAmisEnvoie($id, $id2)
    {
        $req = DB::select('select * from message_entre_amis where profil_id = ? and profil_suivi_id = ? or profil_id = ? and profil_suivi_id = ? order by mea_id asc', [$id2, $id, $id, $id2]);

        MessageEntreAmis::create([
            'content' => request('message'),
            'profil_id' => $id,
            'profil_suivi_id' => $id2,
        ]);

        return back();

    }

    public function messageEntreAmis($id, $id2)
    {
        if (Auth::guest()) {
            return back();
        } else if (Auth::user()->id != $id) {
            if (Auth::user()->id != $id2) {
                return back();
            }
        }

        $messages = DB::select('select * from message_entre_amis where profil_id = ? and profil_suivi_id = ? or profil_id = ? and profil_suivi_id = ? order by mea_id asc', [$id2, $id, $id, $id2]);

        return view('message', [
            'messages' => $messages,
            'id' => $id,
            'id2' => $id2
        ]);

    }
}
