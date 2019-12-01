<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $canals = \App\Canal::all();
        return view('admin', [
            'canals' => $canals
        ]);
    }

    public function supprCanal($id)
    {
        DB::table('canals')->where('canal_id', '=', $id)->delete();
        return redirect('/admin');
    }
}
