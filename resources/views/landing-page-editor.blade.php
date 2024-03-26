@extends('layouts.main')

@section('main-content')
    <div class="container">

        @foreach($components as $component)

            <a href="/landing/editor/remove/{{$component->id}}">Eruit kankeren</a>
            <a href="/landing/editor/up/{{$component->id}}">Omhoog kankeren</a>
            <a href="/landing/editor/down/{{$component->id}}">Omlaag kankeren</a>

            @if($component->type == 'text-component')
                <x-text-component :component="$component"/>
            @elseif($component->type == 'image-component')
                <x-image-component :component="$component" />
            @endif
        @endforeach

        <form enctype="multipart/form-data" action="/landing/editor/add" method="POST">
            @csrf

            <select name="type" onchange="show()" id="select" class="text-slate-950">
                <option value="none" selected>Select type</option>
                @foreach(\App\enum\ComponentType::cases() as $type)
                    <option class="text-slate-950" value="{{$type}}">{{$type}}</option>
                @endforeach
            </select>

            <div id="text-component" class="hidden">
                <p>Text:</p>
                <input name="text" type="text">

                <p>Font size:</p>
                <input min="12" max="72" name="size" type="number">
            </div>

            <div id="image-component" class="hidden">
                <p>PLAATJE</p>
                <input name="image" type="file" />
                @error('image')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <p>Onderschrift</p>
                <input type="text" name="description" >
            </div>

            @error('type')
            <p class="text-red-500">{{ $message }}</p>
            @enderror

            @error('image')
            <p class="text-red-500">{{ $message }}</p>
            @enderror

            <input type="submit">
        </form>
    </div>

    <script>
        const imageForm = document.getElementById('image-component');
        const textForm = document.getElementById('text-component');

        const select = document.getElementById('select');

        function show() {

            const id = select.value.toLowerCase();

            hideAll();

            let element = document.getElementById(id);

            if(!element) return;

            element.classList.remove('hidden');
        }

        function hideAll() {
            imageForm.classList.add('hidden');
            textForm.classList.add('hidden');
        }
    </script>
@endsection
