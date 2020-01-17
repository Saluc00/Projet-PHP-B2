@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
=======

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
<hr>
                            {{-- pseudo --}}
                            <div class="form-group row">                                
                                <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">Pseudo</label>
                                <div class="col-md-6">
                                    <input  class="form-control" name="pseudo">
                                </div>
                            </div>

                            {{-- nom --}}
                            <div class="form-group row">                                
                                <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">Nom</label>
                                <div class="col-md-6">
                                    <input  class="form-control" name="nom">
                                </div>
                            </div>
                            
                            {{-- prénom --}}
                            <div class="form-group row">                                
                                <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">Prénom</label>
                                <div class="col-md-6">
                                    <input  class="form-control" name="prenom">
                                </div>
                            </div>

                            {{-- Téléphone --}}
                            <div class="form-group row">                                
                                <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">Téléphone</label>
                                <div class="col-md-6">
                                    <input  class="form-control" name="phone">
                                </div>
                            </div>
                            
                            {{-- Age --}}
                            <div class="form-group row">                                
                                <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">Age</label>
                                <div class="col-md-6">
                                    <input  class="form-control" name="age">
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
>>>>>>> master
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
