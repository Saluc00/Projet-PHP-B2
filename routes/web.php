<?php

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

Route::get('/', 'InscriptionController@formulaire');

Route::post('/', 'InscriptionController@traitement');

Route::get('/chat', function () {
    $messages = App\Message::all();

    return view( 'chat', [
        'messages' => $messages
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/messages', 'MessageController@envoie');

Route::get('/canals', function () {
    $canals = App\Canal::all();

    return view('canals', [
        'canals' => $canals
    ]);
});