<?php use Spatie\Permission\Models\Role; ?>

@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Canal</h1>

    @if ( Auth::guest() || Auth::user()->hasRole('user'))
    <ul>
        @foreach($canalsPublic as $canal)
        <li><a href="{{ url('canal').'/'.$canal->canal_id }}">{{ $canal->titre }}</a></li>
        @endforeach
    </ul>

    @elseif (Auth::user()->hasRole('vip') || Auth::user()->hasRole('admin'))
    <form action="/canals" method="post">
        {{ csrf_field() }}
        <input name="titre" placeholder="Titre">
        <input type="submit" value="Envoyer">
        @if (Auth::user()->hasRole('admin'))
        <INPUT type="checkbox" name="estPrive" value="1"> Canal Privé
        @endif
    </form>
    <ul>
        @foreach($canals as $canal)
        <li><a href="{{ url('canal').'/'.$canal->canal_id }}">{{ $canal->titre }}
                @if ($canal->estPrive == 1)
                (privé)
                @endif </a></li>
        @endforeach
    </ul>
    @endif
</div>
@endsection
