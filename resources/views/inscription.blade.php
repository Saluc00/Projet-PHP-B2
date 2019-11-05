@extends('layouts.app')

@section('content')
<form action="/inscription" method="post">
    {{ csrf_field() }}
    <input type="text" name="nom" placeholder="Nom">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="password" name="password_confirmation" placeholder="Mot de passe">
    <input type="submit" value="Envoyer">
</form>

@endsection