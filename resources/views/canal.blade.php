@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container-fluid position-absolute">
    
    {{-- <div class="col-2 border border-dark rounded m-3 p-2" id="listUser">
        <h3 class="text-center">Connéctés</h3>
        <hr>
    </div>
</div> --}}

<div class="container">

    <h1 class="text-center m-3">Canal: <strong>{{ ucfirst($canal->titre) }}</strong></h1>

    <div id="text-msg" style="height: 60vh;" class="border rounded bourder-dark p-3 m-t3 overflow-auto messageEnDirect">
        @foreach($messages as $message)
            <div class="msg" style="text-overflow: ellipsis; word-wrap: break-word;">
                <p>
                    <a @if ($message->user_id == auth()->user()->id) class="text-danger" @else class="text-primary" @endif href="{{ url('profile').'/'.$message->user_id }}">{{ (DB::table('profiles')->where('user_id', '=', $message->user_id)->get())[0]->pseudo }}</a>: {{ $message->content }}
                </p>
            </div>
        @endforeach
    </div>

    @if (! Auth::guest())
        <form action="{{ url('canal').'/'.$canal->canal_id }}" method="post" id="monform" class="mt-3">
            {{ csrf_field() }}
            <div class="input-group">
                <textarea id="text" name="message" class="form-control" aria-label="With textarea"></textarea>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon1">Envoyer</button>
                </div>
            </div>
        </form>
    @endif

    <hr>
    <a href="/canals">Retour au canals ici</a>

</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })

    function reload(nbrMessagePrecendent) {
        // regarde les personne dans le tchat
        // $.get('http://192.168.10.10/canalUsers/{{$canal->canal_id }}', function (data) {
        //     let d = JSON.parse(data)
        //     let verif = 0;
        //     d.forEach(element => {
        //         if (element.pseudo == '{{ DB::table('profiles')->where('profile_id', '=', auth()->user()->id)->get()[0]->pseudo }}') {
        //             verif += 1
                    
        //         }
        //         console.log(verif)        
        // });
        // if (verif == 0) {
        //             $.post('http://192.168.10.10/canalUsers/{{$canal->canal_id }}')
        //         }
        // d.forEach(element => {
        //         document.getElementById('listUser').innerHTML += `<div>`+ element.pseudo + `</div>`
        //     });
        // });
        // =========== Recupere les messages

        $.post("http://192.168.10.10/canalDB/{{ $canal->canal_id }}", function (data) {
            console.log(data);
        })

        $.get("http://192.168.10.10/canalDB/{{ $canal->canal_id }}", function (data) {
            const nbrMessageActuel = data.length

            if (nbrMessageActuel > nbrMessagePrecendent) {
                $('.messageEnDirect').append('<div class="msg" style="text-overflow: ellipsis; word-wrap: break-word;">' +
                    '                    <p>' +
                    '                        <a href=\"/profile/' + data[0].user_id + '\">' + data[0].pseudo + ' </a>: ' + data[0].content +
                    '                    </p>' +
                    '                </div>');
                    
                scrollEnBas = document.getElementById('text-msg');
                scrollEnBas.scrollTop = scrollEnBas.scrollHeight;
            }

            setTimeout(reload(nbrMessageActuel));

<<<<<<< Updated upstream
        function reload(nbrMessagePrecendent) {
            // affiche BDD
            $.get("http://192.168.10.10/canalDB/{{ $canal->canal_id }}", function (data) {
                const nbrMessageActuel = data.length

                if (nbrMessageActuel > nbrMessagePrecendent) {
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
        $.get("http://192.168.10.10/canalDB/{{ $canal->canal_id }}", function (data) {
            reload(data.length)
=======
>>>>>>> Stashed changes
        }, 'json')

    }


    const lien = document.getElementById("monform").action
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
    $.get("http://192.168.10.10/canalDB/{{ $canal->canal_id }}", function (data) {
        reload(data.length)
    }, 'json')
</script>

<script>
    scrollEnBas = document.getElementById('text-msg');
    scrollEnBas.scrollTop = scrollEnBas.scrollHeight;
</script>

@endsection
