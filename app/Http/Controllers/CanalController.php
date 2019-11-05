<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CanalController extends Controller
{
    public function formulaire()
    {
        $canals = \App\Canal::all();

        return view('canals', [
            'canals' => $canals
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

        echo request('titre');
    }
}
