@extends('layouts.app')

@section('content')
<form action="/connexion" method="post">
    {{ csrf_field() }}
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="submit" value="Envoyer">
</form>

@endsection