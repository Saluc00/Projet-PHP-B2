<?php

use App\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::middleware(['banned'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('index');

    Route::get('/canals', function () {
        return view('canals');
    })->name('canals');

    Route::get('/chat', function () {
        $messages = App\Message::all();
        return view('chat', [
            'messages' => $messages
        ]);
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/messages', 'MessageController@envoie')->name('messages');

    Route::get('/canals', 'CanalController@formulaire');
    Route::post('/canals', 'CanalController@traitement');

    Route::get('/canal/{id}', 'CanalController@returnCanal');

    Route::get('/profile/{id}', 'ProfileController@returnProfile');
    Route::post('/ajouterAmi/{id}', 'ProfileController@ajoutAmi');
    Route::get('/retirerAmi/{idsuppr}-{idenvoie}', 'ProfileController@retirerAmi');

    Route::post('/canal/{id}', 'CanalController@envoieMessage');
    Route::get('/canalDB/{id}', function ($id) {
        echo json_encode(DB::table('messages')
            ->join('profiles', 'profiles.user_id', '=', 'messages.user_id')
            ->where('messages.fk_canal_id', '=', $id)
            ->orderBy('id', 'desc')
            ->get());
    });

    Route::get('/admin', 'AdminController@index');
    Route::get('/delete/canal/{id}', 'AdminController@supprCanal');
    Route::get('/change/role/{id_user}/{id_role}', 'AdminController@changeRole');

    Route::get('/test', function () {
        $event = new \App\TestEvent();
        event($event);
        dd();
    });

    Route::get('/vip', function () {
        Auth::user()->assignRole('vip');
        return back();
    });

    Route::post('/envoie/message/{id}-{id2}', 'MessageController@messageEntreAmisEnvoie');
    Route::get('/message/{id}-{id2}', 'MessageController@messageEntreAmis');
});

Route::middleware(['notBanned'])->group(function () {
    Route::get('/banned', 'BannedController@initialisation');
});
