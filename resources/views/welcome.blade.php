@extends('layouts.main')

@section('page-title', "Home")

@section("main-content")
    <x-list-component :advertisements="$advertisements"/>
@endsection

