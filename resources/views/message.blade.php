@extends('layouts.app')

@section('content')

    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">console.log('oui')</script>

    <div class="container">
        <div id="messages" style="height: 60vh;" class="border rounded bourder-dark p-3 m-3 overflow-auto">
            @foreach($messages as $message)
                <div style="text-overflow: ellipsis; word-wrap: break-word;">
                    <p>
                        <a href="/profile/{{ DB::table('profiles')->where('profile_id', '=', $message->profil_id)->get()[0]->profile_id }}">{{ DB::table('profiles')->where('profile_id', '=', $message->profil_id)->get()[0]->pseudo }}</a>:
                        {{ $message->content }}</p>
                </div>
            @endforeach
        </div>

        <form action="/envoie/message/{{ $id }}-{{ $id2 }}" method="post" class="m-auto">
            {{ csrf_field() }}
            <div class="input-group m-3">
                <textarea name="message" class="form-control" aria-label="With textarea"></textarea>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon1">Envoyer</button>
                </div>
                @if($errors->has("message"))
                    <p class="help is-danger">{{ $errors->first('message') }}</p>
                @endif
            </div>
        </form>
    </div>

    <script>
        scrollEnBas = document.getElementById('messages');
        scrollEnBas.scrollTop = scrollEnBas.scrollHeight;
    </script>
@endsection
