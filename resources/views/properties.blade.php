@extends('layouts.main')

@section('page-title', "Properties")

@section("main-content")
    <div>
        <h3 class="text-2xl">Colors</h3>

        <h4 class="text-xl">Primary color:</h4>
        <div class="flex">
            <!-- PRIMARY COLOR -->
            <x-form action="/properties/primary-color" method="POST">
                <x-dropdown-select :options="$colors" :selected="$primary_color"/>

                <x-submit-button/>
            </x-form>

            <!-- PRIMARY OPACITY -->
            <x-form action="/properties/primary-opacity" method="POST">
                <x-dropdown-select :options="$opacities" :selected="$primary_opacity"/>

                <x-submit-button/>
            </x-form>
        </div>


        <h4 class="text-xl">Background color:</h4>
        <div class="flex">
            <!-- BACKGROUND-COLOR -->
            <x-form action="/properties/background-color" method="POST">
                <x-dropdown-select :options="$colors" :selected="$background_color"/>

                <x-submit-button/>
            </x-form>

            <!-- BACKGROUND OPACITY -->
            <x-form action="/properties/background-opacity" method="POST">
                <x-dropdown-select :options="$opacities" :selected="$background_opacity"/>

                <x-submit-button/>
            </x-form>
        </div>

        <h4 class="text-xl">Text color:</h4>
        <div class="flex">
            <!-- TEXT COLOR -->
            <x-form action="/properties/text-color" method="POST">
                <x-dropdown-select :options="$colors" :selected="$primary_color"/>

                <x-submit-button/>
            </x-form>

            <!-- TEXT OPACITY -->
            <x-form action="/properties/text-opacity" method="POST">
                <x-dropdown-select :options="$opacities" :selected="$primary_opacity"/>

                <x-submit-button/>
            </x-form>
        </div>

        <h4 class="text-xl">Secondary text color:</h4>
        <div class="flex">
            <!-- TEXT COLOR -->
            <x-form action="/properties/secondary-text-color" method="POST">
                <x-dropdown-select :options="$colors" :selected="$primary_color"/>

                <x-submit-button/>
            </x-form>

            <!-- TEXT OPACITY -->
            <x-form action="/properties/secondary-text-opacity" method="POST">
                <x-dropdown-select :options="$opacities" :selected="$primary_opacity"/>

                <x-submit-button/>
            </x-form>
        </div>

        <h3 class="text-2xl">Misc</h3>
        <!-- ROUNDED -->
        <x-form action="/properties/border-radius" method="POST">

            <div class="flex justify-center">
                <x-radio-select :options="$rounded" :selected="$border_radius"/>
            </div>

            <x-submit-button/>
        </x-form>

        <!-- SHADOW -->
        <x-form action="/properties/shadow" method="POST">

            <div class="flex justify-center">
                <x-radio-select :options="$shadows" :selected="$shadow"/>
            </div>

            <x-submit-button/>
        </x-form>


        <h3 class="text-2xl">Spacing</h3>
        <!-- PADDING -->
        <x-form action="/properties/padding" method="POST">
            <div class="flex justify-center gap-4">
                <x-radio-select :options="$paddings" :selected="$padding"/>
            </div>

            <x-submit-button/>
        </x-form>

        <!-- MARGIN -->
        <x-form action="/properties/margin" method="POST">
            <div class="flex justify-center gap-4">
                <x-radio-select :options="$margins" :selected="$margin"/>
            </div>

            <x-submit-button/>
        </x-form>
    </div>
@endsection
