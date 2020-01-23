@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<div class="container">

    <h1 class="text-center m-3">Canal: <strong>{{ ucfirst($canal->titre) }}</strong></h1>

    <div id="text-msg"  style="height: 60vh;" class="border rounded bourder-dark p-3 m-t3 overflow-auto">
        @foreach($messages as $message)
            <div class="msg" style="text-overflow: ellipsis; word-wrap: break-word;">
                <p>
                    <a href="{{ url('profile').'/'.$message->user_id }}">{{ (DB::table('profiles')->where('user_id', '=', $message->user_id)->get())[0]->pseudo }}</a>: {{ $message->content }}
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
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
})

function reload() {
    // affiche BDD
    $.get("http://192.168.10.10/canalDB/{{ $canal->canal_id }}", function(data){
            console.log(data)
        }, 'json')
    setTimeout(reload, 10000);
}
reload()

const lien = document.getElementById("monform").action
document.getElementById('button-addon1').addEventListener('click', function (e) {
    e.preventDefault();
    let msg = { 'message'  : document.getElementById('text').value }

    $.ajax({
        url: lien,
        data: msg,
        type: 'POST',
        // Ici quand la requete fonctionne faire une action !
        //success: ,
        dataType: 'json',
    })    
})
$.get("http://192.168.10.10/canalDB/{{ $canal->canal_id }}", function(data){
    console.log(data)
}, 'json')
</script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.15/vue.min.js"></script>
<script>
    var socket = io();
    new Vue({
        el: '#test',

        data: {
            message: ''
        },

        methods: {
            send: function(e) {
                socket.emit('message_send', this.message);

                this.message = '';

                e.preventDefault();
            }
        }

    })
</script> --}}

@endsection
