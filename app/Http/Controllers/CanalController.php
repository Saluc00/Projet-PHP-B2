<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
        $messages = DB::table('messages')->where('fk_canal_id', '=', $id)->get();
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

        return redirect('canal' . '/' . $id);
    }
}
