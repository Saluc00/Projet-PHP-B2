@extends('layouts.app')

@section('content')

</h1>Canal: <strong>{{ $canal->titre }}</strong></h1>


<div>
    @foreach($messages as $message)
        <p>
            <a href="{{ url('profile').'/'.$message->user_id }}">{{ (DB::table('profiles')->where('user_id', '=', $message->user_id)->get())[0]->pseudo }}</a>: {{ $message->content }}
        </p>
    @endforeach
</div>

@if (! Auth::guest())
    <form action="{{ url('canal').'/'.$canal->canal_id }}" method="post">
        {{ csrf_field() }}
        <textarea name="message" placeholder="Message"></textarea>
        <input type="submit" value="Envoyer">
    </form>
@endif

<hr>
<a href="/canals">Retour au canals ici</a>
@endsection
