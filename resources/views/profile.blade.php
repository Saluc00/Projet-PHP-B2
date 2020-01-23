@extends('layouts.app')

@section('content')

<div class="container">
    </h1>Profil de : <strong>{{ $profile->pseudo }}</strong></h1>

    <div>
        <ul>
            <li>Nom: {{ $profile->nom }}</li>
            <li>Prénom: {{ $profile->prenom }}</li>
            <li>Age: {{ $profile->age }}</li>
            <li>Téléphone: {{ $profile->telephone }}</li>
        </ul>
    </div>

    <div>
        <h2>Abonnements:</h2>
        <div class="list-group ">
            @foreach($abonnements as $abonnement)
            <div class="mt-2 list-group-item list-group-item-action d-flex justify-content-between flex-row">
                <p class="col-9"><a  href="{{ url('profile').'/'.$abonnement->profil_suivi_id }}">{{ (DB::table('profiles')->where('profile_id', '=', $abonnement->profil_suivi_id)->get())[0]->pseudo }}</a>
                    @if ( auth()->user()->id == $profile->profile_id)</p>
                
                    <div class="col-3">
                        <a class="btn btn-primary" href="{{ url('message').'/'. $abonnement->profil_suivi_id}}-{{ auth()->user()->id }}" role="button">Discuter</a>                   
                        <a class="btn btn-danger" href="{{ url('retirerAmi').'/'.$abonnement->profil_suivi_id.'-'. auth()->user()->id }}" role="button">Supprimer</a>
                    </div>
                    
                    @endif
            </div>
            @endforeach
            </div>
    </div>

    <div>
        <h2>Abonnés:</h2>
        <div class="list-group d-flex justify-content-between">
            @foreach($abonnes as $abonne)
            
            <p class="list-group-item list-group-item-action">
                <a href="{{ url('profile').'/'.$abonne->profil_id }}">{{ (DB::table('profiles')->where('profile_id', '=', $abonne->profil_id)->get())[0]->pseudo }}
                </a>
            </p>
            @endforeach
        </div>
    </div>

@if(!Auth::guest())
    @if((DB::table('profiles')->where('user_id', '=', Auth::user()->id)->get())[0]->profile_id != $profile->profile_id)
        @if(! $estSuivi)
            <form action="{{ url('ajouterAmi').'/'.$profile->profile_id }}" method="post">
                {{ csrf_field() }}
                <input type="submit" value="Ajouter en ami">
            </form>
        @else
            <form action="{{ url('retirerAmi').'/'.$profile->profile_id }}" method="post">
                {{ csrf_field() }}
                <input type="submit" value="Retirer cet ami">
            </form>
        @endif
    @endif
@endif

</div>
@endsection