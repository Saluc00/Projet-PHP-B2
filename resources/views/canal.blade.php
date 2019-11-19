@extends('layouts.app')

@section('content')

<h1>Canal: {{ $canal->titre }}</h1>

<form action="/canals" method="post">
    {{ csrf_field() }}
    <input name="titre" placeholder="Titre">
    <input type="submit" value="Envoyer">
</form>

<!--<p>{{ Auth::user()->id }}</p> -->


@endsection