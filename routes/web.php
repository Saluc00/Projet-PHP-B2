<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/canals', function () {
    return view('canals');
})->name('canals');


Route::get('/inscription', 'InscriptionController@formulaire');
Route::post('/inscription', 'InscriptionController@traitement');

Route::get('/connexion', 'ConnexionController@formulaire');
Route::post('/connexion', 'ConnexionController@traitement');

Route::get('/chat', function () {
    $messages = App\Message::all();
    return view('chat', [
        'messages' => $messages
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/messages', 'MessageController@envoie')->name('messages');

Route::get('/canals', 'CanalController@formulaire');
Route::post('/canals', 'CanalController@traitement');

Route::get('/canal/{id}', 'CanalController@returnCanal');

Route::get('/profile/{id}', 'ProfileController@returnProfile');
Route::post('/ajouterAmi/{id}', 'ProfileController@ajoutAmi');
Route::get('/retirerAmi/{idsuppr}-{idenvoie}', 'ProfileController@retirerAmi');

Route::post('/canal/{id}', 'CanalController@envoieMessage');

Route::get('/admin', 'AdminController@index');
Route::get('/delete/canal/{id}', 'AdminController@supprCanal');

Route::get('/test', function () {
    $event = new \App\TestEvent();
    event($event);
    dd();
});


Route::post('/envoie/message/{id}', 'MessageController@messageEntreAmisEnvoie');
Route::get('/message/{id}', 'MessageController@messageEntreAmis');