<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }
}
