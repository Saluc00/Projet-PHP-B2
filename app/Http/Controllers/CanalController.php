<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CanalController extends Controller
{
    public function formulaire()
    {
        $canals = \App\Canal::all();
        $user = auth();

        return view('canals', [
            'canals' => $canals,
            'user' => $user
        ]);
    }

    public function traitement()
    {
        $resultat = request()->validate([
            'titre' => ['required']
        ]);

        $canals = \App\Canal::create([
            'titre' => request('titre')
        ]);

        return redirect('canals');
    }

    public function returnCanal($id)
    {

        $canal = DB::table('canals')->where('canal_id', '=', $id)->get();
        $messages = DB::table('messages')->where('fk_canal_id', '=', $id)->get();
        return view('canal', [
            'canal' => $canal[0],
            'messages' => $messages
        ]);
    }

    public function envoieMessage($id)
    {
        DB::table('messages')->insert(['content' => request('message'), 'user_id' => Auth::user()->id, 'fk_canal_id' => $id]);
        return redirect('canal'.'/'.$id);
    }
}
