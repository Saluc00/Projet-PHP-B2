@extends('layouts.app')

@section('content')

<div class="container">
    @foreach($messages as $message)
    <li> {{ DB::table('profiles')->where('profile_id', '=', $message->profil_id)->get()[0]->pseudo }} ->
        {{ $message->content }}</li>
    @endforeach
    <form action="/envoie/message/{{ $id }}" method="post">

        {{ csrf_field() }}
        <div>
            <label class="label">Message</label>
            <div>
                <textarea name="message"></textarea>
            </div>
            @if($errors->has("message"))
            <p class="help is-danger">{{ $errors->first('message') }}</p>
            @endif
        </div>

        <div>
            <button type=submit>Publier</button>
        </div>
    </form>
</div>
@endsection
