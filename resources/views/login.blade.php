@extends('layouts.main')

@section('page-title', 'Login')

@section("main-content")
    <form action="/login" method="post">
        @csrf

        <x-text-input placeholder="{{__('login.email')}}" type="email" name="email"/>
        <x-text-input placeholder="{{__('login.password')}}" type="password" name="password"/>

        <input class="{{$button}}" type="submit" value="{{__('login.login')}}"/>
    </form>

@endsection
