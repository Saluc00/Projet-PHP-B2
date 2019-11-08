<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($id)
    {
        $canal = Canal::where('id', $id)->get();
    }
}
