@extends('layouts.main')

@section('page-title', 'Account')

@section("main-content")
    <h2>Aanbieding toevoegen</h2>
    <x-form action="{{ route('sellers.createadvertisement', ['userId' => $userId]) }}" method="POST">
        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="description">Beschrijving:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="type">Type:</label><br>
        <select id="type" name="type">
            <option value="Huur">Huur</option>
            <option value="Verkoop">Verkoop</option>
        </select><br>
        <label for="expiration">Vervaldatum:</label><br>
        <input type="date" id="expiration" name="expiration"><br>
        <button type="submit">Aanbieding toevoegen</button>
    </x-form>
@endsection
