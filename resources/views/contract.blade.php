@extends('layouts.main')

@section('page-title', __('contract.title'))

@section("main-content")

    <div class="bg-gray-800 rounded-lg flex flex-col items-center justify-center p-5">

        <h1 class="text-2xl font-bold mb-4">{{ __('contract.contractpage') }}</h1>
        <x-contract userid="{{$userid}}"></x-contract>

        @if(!empty($contracts))
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-4">{{ __('contract.contracts') }}</h1>
            <ul>
                @foreach ($contracts as $contract)
                    <li>
                        <a href="{{ asset('storage/contracts/' . basename($contract)) }}">{{ basename($contract) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
@endsection
