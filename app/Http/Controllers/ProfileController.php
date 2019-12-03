<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Ami;

class ProfileController extends Controller
{
    public function returnProfile($id)
    {
        $profile = DB::table('profiles')->where('profile_id', '=', $id)->get();
        $estSuivi = DB::table('amis')->where('profil_id', '=', (DB::table('profiles')->where('user_id', '=', Auth::user()->id)->get())[0]->profile_id)->where('profil_suivi_id', '=', $id)->get();
        $abonnements = DB::table('amis')->where('profil_id', '=', $id)->get();
        $abonnes = DB::table('amis')->where('profil_suivi_id', '=', $id)->get();

        return view('profile', [
            'profile' => $profile[0],
            'estSuivi' => $estSuivi->isNotEmpty(),
            'abonnements' => $abonnements,
            'abonnes' => $abonnes
        ]);
    }

    public function ajoutAmi($id)
    {
        Ami::create([
            'profil_id' => (DB::table('profiles')->where('user_id', '=', Auth::user()->id)->get())[0]->profile_id,
            'profil_suivi_id' => $id
        ]);

        return redirect('/profile/' . $id);
    }

    public function retirerAmi($id)
    {
        DB::table('amis')
            ->where('profil_id', Auth::user()->id)
            ->where('profil_suivi_id', $id)
            ->delete();

        return redirect('/profile/' . $id);
    }
}
