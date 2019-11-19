@extends('layouts.app')

@section('content')

<h1>Canal</h1>

<form action="/canals" method="post">
    {{ csrf_field() }}
    <input name="titre" placeholder="Titre">
    <input type="submit" value="Envoyer">
</form>

<!--<p>{{ Auth::user()->id }}</p> -->


<ul>
    @foreach($canals as $canal)
        <li><a href="{{ url('canal').'/'.$canal->canal_id }}">{{ $canal->titre }}</a></li>
    @endforeach
</ul>

@endsection