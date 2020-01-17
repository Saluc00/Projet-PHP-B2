<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
<<<<<<< Updated upstream
use Illuminate\Support\Facades\Auth;
=======
use App\Events\PremierEvent;
>>>>>>> Stashed changes

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::guest()) {
            $user = Auth::user();
            $user = json_encode($user);
            event(new PremierEvent($user)); # ici on appel l'event en lui envoyant le user connecté    
        }
        return view('home');    
    }
}