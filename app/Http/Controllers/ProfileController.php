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
        $abonnements = DB::table('amis')->where('profil_id', '=', $id)->get();
        $abonnes = DB::table('amis')->where('profil_suivi_id', '=', $id)->get();

        if (!Auth::guest()) {
            $estSuivi = DB::table('amis')->where('profil_id', '=', (DB::table('profiles')->where('user_id', '=', Auth::user()->id)->get())[0]->profile_id)->where('profil_suivi_id', '=', $id)->get();
            return view('profile', [
                'profile' => $profile[0],
                'estSuivi' => $estSuivi->isNotEmpty(),
                'abonnements' => $abonnements,
                'abonnes' => $abonnes
            ]);
        } else {
            $estSuivi = false;
            return view('profile', [
                'profile' => $profile[0],
                'estSuivi' => $estSuivi,
                'abonnements' => $abonnements,
                'abonnes' => $abonnes
            ]);
        }
    }

    public function ajoutAmi($id)
    {
        if (Auth::user()->hasRole('user')) {
            $nombreAmi = DB::select('select count(profil_id) nombreAmi from amis where profil_id = (select profile_id from profiles where user_id = ' . Auth::user()->id . ') ');
            if ($nombreAmi[0]->nombreAmi == 10) {
                echo "Vous avez déja atteind le maximum d'ami ! Passez en VIP pour pouvoir en ajouter plus.";
                return back();
            }
        }
        Ami::create([
            'profil_id' => (DB::table('profiles')->where('user_id', '=', Auth::user()->id)->get())[0]->profile_id,
            'profil_suivi_id' => $id
        ]);

        return redirect('/profile/' . $id);
    }

    public function retirerAmi($idsuppr, $idenvoie)
    {
        DB::table('amis')
            ->where('profil_id', $idenvoie)
            ->where('profil_suivi_id', $idsuppr)
            ->delete();

        return redirect('/profile/' . $idenvoie);
    }
}
