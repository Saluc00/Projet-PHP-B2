<?php use Spatie\Permission\Models\Role; ?>

@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Canal</h1>

    <form action="/canals" method="post">
        {{ csrf_field() }}
        <input name="titre" placeholder="Titre">
        <input type="submit" value="Envoyer">
        @if (Auth::user()->hasRole('vip') || Auth::user()->hasRole('admin'))
        <INPUT type="checkbox" name="estPrive" value="1"> Canal Privé
        @endif
    </form>
    
    <ul class="list-group">
        @foreach($canals as $canal)
        <li class="list-group-item list-group-item-action d-flex justify-content-between ">
            <p>{{ ucfirst($canal->titre) }}. @if ($canal->estPrive == 1)(privé)  @endif </p> <button onclick="window.location.href='{{ url('canal').'/'.$canal->canal_id }}'" type="button" class="btn btn-primary">Entrer</button>
        </li>
        @endforeach
    </ul>
    
</div>
@endsection
