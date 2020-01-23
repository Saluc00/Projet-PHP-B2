<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\UnMail;

class CanalController extends Controller
{
    public function formulaire()
    {
        $canals = \App\Canal::all();
        $canalsPublic = \App\Canal::all()->where('estPrive', '=', 0);
        $user = auth();

        return view('canals', [
            'canals' => $canals,
            'canalsPublic' => $canalsPublic,
            'user' => $user
        ]);
    }

    public function traitement()
    {
        $resultat = request()->validate([
            'titre' => ['required'],
        ]);

        $canals = \App\Canal::create([
            'titre' => request('titre'),
            'estPrive' => request('estPrive') ?? 0
        ]);

        return redirect('canals');
    }

    public function returnCanal($id)
    {

        $canal = DB::table('canals')->where('canal_id', '=', $id)->get();
        $messages = DB::table('messages')->where('fk_canal_id', '=', $id)->orderBy('id', 'desc')->get();
        if ($canal[0]->estPrive && (Auth::guest() || Auth::user()->hasRole('user'))) {
            return redirect('canals');
        }
        return view('canal', [
            'canal' => $canal[0],
            'messages' => $messages
        ]);
    }

    public function envoieMessage($id)
    {
        $resultat = request()->validate([
            'message' => ['required'],
        ]);

        $canals = \App\Message::create([
            'content' => request('message'),
            'user_id' => Auth::user()->id,
            'fk_canal_id' => $id
        ]);

        $dateNewMessage = $canals->created_at;

        $dateLastMessage = DB::table('messages')->where('created_at', '<', $dateNewMessage)->latest()->limit(1)->get()[0]->created_at;
        $diffDate = strtotime($dateNewMessage) - strtotime($dateLastMessage);

        // if ( $diffDate > 10  /* Si un message a été envoyé apres 1h */ ) {
        //     // 
        // }

        $messages = DB::table('messages')->where('fk_canal_id', '=', $id) ->orderBy('id', 'desc')->get();
        return redirect('canal' . '/' . $id);
    }
}
