<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
            Auth::attempt(['email' => request('email'), 'password' => request('password')]);
            return redirect('home');
        } else 
        {
            echo 'non';
        }
    }
}
