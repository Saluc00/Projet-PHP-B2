@extends('layouts.app')

@section('content')


<div class="container">

@if (Auth::user()->hasRole('admin'))

        <h2>Canaaux :</h2>
        @foreach($canals as $canal)
            <div>
                <li><strong>{{ $canal->titre }}</strong></li> @if($canal->estPublic == 0) <p>Privée</p> @else <p>
                    Public</p> @endif
                <a href="delete/canal/{{ $canal->canal_id }}">
                    <button>Supprimer</button>
                </a>
            </div>
            <hr>
        @endforeach

        <h2>User</h2>


        @foreach($users as $user)
            <div>
                <li><strong>{{ $user->email }}</strong></li>
                <a href="ban/user/{{ $user->id }}">
                    <button>Bannir</button>
                </a>
            </div>
            <hr>
        @endforeach

    @else
        <h1>error 404</h1>
    @endif

</div>
@endsection
