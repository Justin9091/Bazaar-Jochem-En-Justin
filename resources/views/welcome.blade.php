@extends('layouts.main')

@section('page-title', "Home")

@section("main-content")
    <x-list-component :advertisments="$advertisments"/>
@endsection
