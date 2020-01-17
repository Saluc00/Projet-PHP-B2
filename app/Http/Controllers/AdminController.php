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
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->whereNotIn('users.id', $listeIdAdmin)
            ->select('users.*', 'roles.name')
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
        return redirect('/admin');
    }

    public function changeRole($id_user, $id_role)
    {
        DB::update('update model_has_roles set role_id = ? where model_id = ? and model_type = ?', [$id_role, $id_user, "App\User"]);

        return redirect('/admin');
    }


}
