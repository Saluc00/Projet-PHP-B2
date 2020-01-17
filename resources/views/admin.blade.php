@extends('layouts.app')

@section('content')


    <div class="container">

        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superAdmin'))

            <h2>Canaux :</h2>
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

                <li><strong>{{ $user->email }}</strong></li>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $user->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="change/role/{{$user->id}}/2">Admin</a>
                        <a class="dropdown-item" href="change/role/{{$user->id}}/3">VIP</a>
                        <a class="dropdown-item" href="change/role/{{$user->id}}/4">Utilisateur</a>
                        <a class="dropdown-item" href="change/role/{{$user->id}}/5">Banni</a>
                    </div>
                </div>
                <hr>
            @endforeach

        @else
            <h1>error 404</h1>
        @endif

    </div>
@endsection
