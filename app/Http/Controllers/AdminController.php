<?php

namespace App\Http\Controllers;

use App\Canal;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        $canals = Canal::all();
        $usersAdmin = DB::select('select model_id from model_has_roles WHERE role_id = 1 and model_type = ?', ['App\User']);

        $listeIdAdmin = [];

        foreach ($usersAdmin as $admin) {
            array_push($listeIdAdmin, $admin->model_id);
        }

        $users = DB::table('users')
            ->whereNotIn('id', $listeIdAdmin)
            ->get();

        return view('admin', [
            'canals' => $canals,
            'users' => $users
        ]);
    }

    public function supprCanal($id)
    {
        DB::table('messages')->where('fk_canal_id', ' = ', $id)->delete();
        DB::table('canals')->where('canal_id', ' = ', $id)->delete();
        return redirect(' / admin');
    }

    public function banUser($id)
    {
        DB::update('update model_has_roles set role_id = 4, where id = ? and model_type = ?', [$id, 'App\User']);

        return redirect(' / admin');
    }


}
