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

    <div class="d-flex">
        <div class="col-6 bg-success m-1">
            @foreach($users as $user)
            <p class="dropdown-item col-10"><strong>{{ $user->email }}</strong><a href="ban/user/{{ $user->id }}">
                <button class="btn btn-primary col-2">Bannir</button>
            </a>
            @endforeach
        </div>
        <div class="col-6 bg-danger m-1">
        fgdn
        </div>
    </div>

    @else
    <h1>error 404</h1>
    @endif

</div>
@endsection
