@extends('layouts.main')

@section('main-content')
    <div class="container">

        <div class="flex flex-col gap-2">
            @foreach($components as $component)

                <div class="bg-gray-800 rounded-lg p-3 flex justify-between items-center">

                    <div class="flex flex-col gap-2">
                        <a class="p-1 bg-blue-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/up/{{$component->id}}">Move up</a>
                        <a class="p-1 bg-red-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/remove/{{$component->id}}">Delete</a>
                        <a class="p-1 bg-blue-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/down/{{$component->id}}">Move down</a>
                    </div>

                    <div class="">
                        @if($component->type == 'text-component')
                            <x-text-component :component="$component"/>
                        @elseif($component->type == 'image-component')
                            <x-image-component :component="$component"/>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="bg-gray-800 rounded-lg p-3">

                <h1 class="text-3xl text-center font-bold p-2">Add component</h1>

                <form enctype="multipart/form-data" action="/landing/editor/add" method="POST">
                    @csrf

                    <select name="type" onchange="show()" id="select" class="text-slate-950 w-full p-2 rounded-lg">
                        <option value="none" selected>Select type</option>
                        @foreach(\App\enum\ComponentType::cases() as $type)
                            <option class="text-slate-950" value="{{$type}}">{{$type}}</option>
                        @endforeach
                    </select>

                    <div id="text-component" class="hidden">
                        <div class="">
                            <p>Text:</p>
                            <input name="text" type="text" class="text-slate-950 w-full p-2 rounded-lg">
                        </div>

                        <div class="">
                            <p>Font size:</p>
                            <input min="12" max="72" name="size" type="number"
                                   class="text-slate-950 w-full p-2 rounded-lg">
                        </div>
                    </div>

                    <div id="image-component" class="hidden">
                        <p>PLAATJE</p>
                        <input name="image" type="file" class="text-slate-950 w-full p-2 rounded-lg bg-white"/>

                        <p>Onderschrift</p>
                        <input type="text" name="description" class="w-full p-2 rounded-lg">
                    </div>

                    @error('type')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-center">
                        <x-submit-button/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const imageForm = document.getElementById('image-component');
        const textForm = document.getElementById('text-component');

        const select = document.getElementById('select');

        function show() {

            const id = select.value.toLowerCase();

            hideAll();

            let element = document.getElementById(id);

            if (!element) return;

            element.classList.remove('hidden');
        }

        function hideAll() {
            imageForm.classList.add('hidden');
            textForm.classList.add('hidden');
        }
    </script>
@endsection
