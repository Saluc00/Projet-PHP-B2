@extends('layouts.app')

@section('content')

    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">console.log('oui')</script>

    <div class="container">
        <div id="text-msg" style="height: 60vh;" class="border rounded bourder-dark p-3 m-3 overflow-auto messageEnDirect">
            @foreach($messages as $message)
                <div style="text-overflow: ellipsis; word-wrap: break-word;">
                    <p>
                        <a href="/profile/{{ DB::table('profiles')->where('profile_id', '=', $message->profil_id)->get()[0]->profile_id }}">{{ DB::table('profiles')->where('profile_id', '=', $message->profil_id)->get()[0]->pseudo }}</a>:
                        {{ $message->content }}</p>
                </div>
            @endforeach
        </div>

        <form id="monform" action="/envoie/message/{{ $id }}-{{ $id2 }}" method="post" class="m-auto">
            {{ csrf_field() }}
            <div class="input-group m-3">
                <textarea id='text' name="message" class="form-control" aria-label="With textarea"></textarea>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon1">Envoyer</button>
                </div>
                @if($errors->has("message"))
                    <p class="help is-danger">{{ $errors->first('message') }}</p>
                @endif
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        function reload(nbrMessagePrecendent) {
            // affiche BDD
            $.get("http://192.168.10.10/messageDB/{{$id}}-{{$id2}}", function (data) {
                const nbrMessageActuel = data.length
                if (nbrMessageActuel > nbrMessagePrecendent) {
                    console.log(data[0])
                    $('.messageEnDirect').append('<div class="msg" style="text-overflow: ellipsis; word-wrap: break-word;">' +
                        '                    <p>' +
                        '                        <a href=\"/profile/' + data[0].user_id + '\">' + data[0].pseudo + ' </a>: ' + data[0].content +
                        '                    </p>' +
                        '                </div>');
                    scrollEnBas = document.getElementById('text-msg');
                    scrollEnBas.scrollTop = scrollEnBas.scrollHeight;
                }
                setTimeout(reload(nbrMessageActuel));
            }, 'json')
        }

        const lien = document.getElementById("monform").action
        console.log(lien)
        document.getElementById('button-addon1').addEventListener('click', function (e) {
            e.preventDefault();
            let msg = {'message': document.getElementById('text').value}
            $.ajax({
                url: lien,
                data: msg,
                type: 'POST',
                // Ici quand la requete fonctionne faire une action !
                //success: ,
                dataType: 'json',
            })
            $('#text').val('')
        })
        $('#text').val('')
        $.get("http://192.168.10.10/messageDB/{{$id}}-{{$id2}}", function (data) {
            reload(data.length)
        }, 'json')
    </script>
@endsection
