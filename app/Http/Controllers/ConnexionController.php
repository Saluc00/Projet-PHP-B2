<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    public function formulaire()
    {
        return view('connexion');
    }

    public function traitement()
    {
        $resultat = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        if ($resultat) {
            return redirect('home');
        } else 
        {
            echo 'non';
        }
    }
}
