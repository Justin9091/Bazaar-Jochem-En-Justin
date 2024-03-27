@extends('layouts.main')

@section('page-title', 'Login')

@section("main-content")
    <div class="flex justify-center">
        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg w-1/2">
            <h1 class="text-3xl font-bold text-center">Login</h1>

            <x-form action="{{route('login.store')}}" method="post">
                <p class="px-3">Email</p>
                <x-text-input placeholder="{{__('login.email')}}" type="email" name="email"/>

                <p class="px-3">Password</p>
                <x-text-input placeholder="{{__('login.password')}}" type="password" name="password"/>

                <div class="flex justify-center">
                    <x-submit-button value="{{__('login.login')}}"/>
                </div>
            </x-form>

        </div>
    </div>
@endsection
