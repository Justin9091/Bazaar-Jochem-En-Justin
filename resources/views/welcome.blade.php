@extends('layouts.main')

@section('page-title', "Home")

@section("main-content")
    <x-Utils.list-component :advertisements="$advertisements"/>
@endsection

