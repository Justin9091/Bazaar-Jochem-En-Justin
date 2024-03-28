@extends('layouts.main')

@section('page-title', 'Login')

@section("main-content")
    <div class="flex justify-center">
        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg w-1/2">
            <h1 class="text-3xl font-bold text-center">Login</h1>

            <x-form.form action="{{route('login.store')}}" method="post">
                <p class="px-3">Email</p>
                <x-form.text-input placeholder="{{__('login.email')}}" type="email" name="email" value=""/>

                <p class="px-3">Password</p>
                <x-form.text-input placeholder="{{__('login.password')}}" type="password" name="password" value=""/>

                <div class="flex justify-center">
                    <x-form.submit-button value="{{__('login.login')}}"/>
                </div>
            </x-form.form>

        </div>
    </div>
@endsection
