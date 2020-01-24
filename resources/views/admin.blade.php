@extends('layouts.app')

@section('content')


    <div class="container">

        @if (!Auth::guest() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superAdmin')))
            <div class="d-flex justify-content-between flex-row">
                <h2 class="col-6 text-center">Serveurs</h2>
                <h2 class="col-6 text-center">Users</h2>
            </div>
            <div class="d-flex justify-content-around flex-row " style="height: 80vh;">

                <div class="col-6 mr-3 overflow-auto">
                    {{-- ahehahejhfdjn --}}
                    <div class="list-group ">
                        @foreach($canals as $canal)
                            <div class="mt-2 list-group-item list-group-item-action">
                                <div class="p-1 bd-highlight  d-flex justify-content-between flex-row">
                                    <p><strong>{{ ucfirst($canal->titre) }}</strong>
                                        @if($canal->estPrive == 1)
                                            Privée</p>
                                    @else
                                        Public</p>
                                    @endif
                                    <button class="btn btn-primary" href="delete/canal/{{ $canal->canal_id }}">
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-6 ml-3 overflow-auto list-group">
                    @foreach($users as $user)

                        <div class="mt-2 list-group-item list-group-item-action">
                            <div class="p-1 bd-highlight  d-flex justify-content-between flex-row">
                                <p class="p-2 bd-highlight"><strong>{{ $user->email }}</strong></p>

                                <div class="dropdown p-2 bd-highlight">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton"
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
                            </div>
                        </div>
                    @endforeach
                </div>

                @else
                    <h1>error 404</h1>
                @endif

            </div>
@endsection
