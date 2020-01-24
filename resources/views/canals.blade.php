<?php use Spatie\Permission\Models\Role; ?>

@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center m-3 border rounded border-dark p-3">Tous les canaux</h1>
        @if (! Auth::guest() && !Auth::user()->hasRole('user'))
            <form action="/canals" method="post" class="mb-3 mt-3">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Titre</label>
                    <input name="titre" class="form-control">
                </div>
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superAdmin'))
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="estPrive" value="1">
                        <label class="form-check-label">Canal Privé</label>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
            <ul class="list-group">
                @foreach($canals as $canal)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between ">
                        <p>{{ ucfirst($canal->titre) }}. @if ($canal->estPrive == 1)(privé) @endif </p>
                        <button
                            onclick="window.location.href='{{ url('canal').'/'.$canal->canal_id }}'" type="button"
                            class="btn btn-primary">Entrer
                        </button>
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="list-group">
                @foreach($canalsPublic as $canal)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between ">
                        <p>{{ ucfirst($canal->titre) }}. @if ($canal->estPrive == 1)(privé) @endif </p>
                        <button
                            onclick="window.location.href='{{ url('canal').'/'.$canal->canal_id }}'" type="button"
                            class="btn btn-primary">Entrer
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>

@endsection
