@extends('layouts.app')
@section('content')

<div class="profil">

    <div class="profil__top">
        <h1>Page profil</h1>
    </div>

    @auth
        <p> {{ Auth::user()->name}} </p>
        <p>{{Auth::id() }}  </p>
        <p> </p>
    @endauth

    <p> {{ Auth::user()->lastname}} </p>
    <p></p>
    <p></p>

</div>

@endsection
