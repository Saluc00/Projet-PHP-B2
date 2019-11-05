<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function formulaire()
    {
        return view('inscription');
    }

    public function traitement()
    {
        request()->validate([
            'nom' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],
        ]);

        $user = \App\User::create([
            'name' => request('nom'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        $resultat = auth()->attempt([
            'name' => request('nom'),
            'email' => request('email'),
            'password' => request('password')
        ]);
        
        if ($resultat) {
            return redirect('home');
        }
    }
}
