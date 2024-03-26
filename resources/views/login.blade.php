@extends('layouts.main')

@section('page-title', 'Login')

@section("main-content")
    <x-form action="/login" method="post">
        <x-text-input placeholder="{{__('login.email')}}" type="email" name="email"/>
        <x-text-input placeholder="{{__('login.password')}}" type="password" name="password"/>

        <x-submit-button value="{{__('login.login')}}"/>
    </x-form>

@endsection
