@extends('layouts.app')

@section('content')

    <h1>Canal</h1>

    <form action="/canals" method="post">
        {{ csrf_field() }}
        <input name="titre" placeholder="Titre">
        <input type="submit" value="Envoyer">
        <INPUT type="checkbox" name="estPublic" value="1" checked> Canal Public
    </form>

<<<<<<< Updated upstream
    <!--<p>{{ Auth::user()->id }}</p> -->
=======
<p>{{ Auth::user->email }}</p>
>>>>>>> Stashed changes

    <ul>
        @foreach($canals as $canal)
            <li><a href="{{ url('canal').'/'.$canal->canal_id }}">{{ $canal->titre }}</a></li>
        @endforeach
    </ul>

@endsection
