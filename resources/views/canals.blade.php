@extends('layouts.app')

@section('content')

<h1>Canal</h1>

<form action="/canals" method="post">
    {{ csrf_field() }}
    <input name="titre" placeholder="Titre">
    <input type="submit" value="Envoyer">
</form>

<ul>
    @foreach($canals as $canal)
        <li>{{ $canal->titre }}</li>
    @endforeach
</ul>

@endsection