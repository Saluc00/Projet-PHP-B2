@extends('layouts.app')

@section('content')


<div class="container">

@if (Auth::user()->hasRole('admin'))


@foreach($canals as $canal)
    <div>
        <li><strong>{{ $canal->titre }}</strong></li> @if($canal->estPublic == 0) <p>Privée</p> @else <p>Public</p> @endif
        <a href="delete/canal/{{ $canal->canal_id }}"><button>Supprimer</boutton></a>
    </div>
    <hr>
@endforeach

@else 
<h1>404</h1>
@endif

</div>
@endsection