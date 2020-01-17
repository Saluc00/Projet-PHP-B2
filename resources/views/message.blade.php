@extends('layouts.app')

@section('content')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">console.log('oui')</script>

<div class="container">
    <div id="messages">
        @foreach($messages as $message)
        <li> {{ DB::table('profiles')->where('profile_id', '=', $message->profil_id)->get()[0]->pseudo }} ->
            {{ $message->content }}</li>
        @endforeach
    </div>
    <form action="/envoie/message/{{ $id }}" method="post">

        {{ csrf_field() }}
        <div>
            <label class="label">Message</label>
            <div>
                <textarea name="message" class="form-control"></textarea>
            </div>
            @if($errors->has("message"))
            <p class="help is-danger">{{ $errors->first('message') }}</p>
            @endif
        </div>

        <div>
            <button type=submit class="btn btn-primary">Publier</button>
        </div>
    </form>
</div>
@endsection
