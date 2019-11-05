@extends('layouts.app')

@section('content')

<h1>Canal</h1>

<ul>
    @foreach($canals as $canal)
        <li>{{ $canal->titre }}</li>
    @endforeach
</ul>

@endsection