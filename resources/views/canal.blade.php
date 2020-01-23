@extends('layouts.app')

@section('content')

    <div class="container">
        </h1>Canal: <strong>{{ $canal->titre }}</strong></h1>

        <div id="test" class="border p-3">
            @foreach($messages as $message)
                <p>
                    <a href="{{ url('profile').'/'.$message->user_id }}">{{ (DB::table('profiles')->where('user_id', '=', $message->user_id)->get())[0]->pseudo }}</a>: {{ $message->content }}
                </p>
            @endforeach
        </div>

        <br>

        @if (! Auth::guest())

            <form action="{{ url('canal').'/'.$canal->canal_id }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Écrivez
                        votre message ici : </label>
                    <textarea v-model="message" name="message" placeholder="Message" class="form-control"
                              id="exampleFormControlTextarea1" rows="3"></textarea>
                    <input type="submit" value="Envoyer" class="btn btn-primary mb-2 float-right">
                </div>
            </form>
        @endif
        <br>
        <hr>
        <a href="/canals">Retour au canals ici</a>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.15/vue.min.js"></script>
    <script>
        var socket = io();
        new Vue({
            el: '#test',

            data: {
                message: ''
            },

            methods: {
                send: function (e) {
                    socket.emit('message_send', this.message);

                    this.message = '';

                    e.preventDefault();
                }
            }

        })
    </script>

@endsection
