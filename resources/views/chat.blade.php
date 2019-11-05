@extends('layouts.app')

@section('content')

<div class="message">

@foreach($messages as $message)
    <li> -> {{ $message->content }}</li>
@endforeach
    <form action="/messages" method="post">

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