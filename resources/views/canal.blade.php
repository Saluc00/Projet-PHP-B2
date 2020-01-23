@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="text-center m-3">Canal: <strong>{{ ucfirst($canal->titre) }}</strong></h1>

    <div id="test"  style="height: 60vh;" class="border rounded bourder-dark p-3 m-t3 overflow-auto">
        @foreach($messages as $message)
            <div style="text-overflow: ellipsis; word-wrap: break-word;">
                <p>
                    <a href="{{ url('profile').'/'.$message->user_id }}">{{ (DB::table('profiles')->where('user_id', '=', $message->user_id)->get())[0]->pseudo }}</a>: {{ $message->content }}
                </p>
            </div>
        @endforeach
    </div>

    @if (! Auth::guest())
        <form action="{{ url('canal').'/'.$canal->canal_id }}" method="post" class="mt-3">
            {{ csrf_field() }}
            <div class="input-group">
                <textarea name="message" class="form-control" aria-label="With textarea"></textarea>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon1">Envoyer</button>
                </div>
            </div>
        </form>
    @endif

    <hr>
<a href="/canals">Retour au canals ici</a>

</div>

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
