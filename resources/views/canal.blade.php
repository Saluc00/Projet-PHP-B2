@extends('layouts.app')

@section('content')

</h1>Canal: <strong>{{ $canal->titre }}</strong></h1>

<div>
    @foreach($messages as $message)
        <p>{{ $message->content }}</p>
    @endforeach
</div>

<form action="{{ url('canal').'/'.$canal->canal_id }}" method="post">
    {{ csrf_field() }}
    <textarea name="message" placeholder="Message"></textarea>
    <input type="submit" value="Envoyer">
</form>

<hr>
<a href="/canals">Retour au canals ici</a>
@endsection
