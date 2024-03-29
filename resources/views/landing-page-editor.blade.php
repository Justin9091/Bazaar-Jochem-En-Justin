@extends('layouts.main')

@section('main-content')
    <div class="container">

        <div class="flex flex-col gap-2">
            @foreach($components as $component)

                <div class="component">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-3 flex justify-between items-center shadow-lg">

                    <div class="flex flex-col gap-2">
                        <a dusk="move-up" class="p-1 bg-blue-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/up/{{$component->id}}">{{@__('editor.move_up')}}</a>
                        <a dusk="delete" class="p-1 bg-red-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/remove/{{$component->id}}">{{@__('editor.delete')}}</a>
                        <a dusk="move-down" class="p-1 bg-blue-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/down/{{$component->id}}">{{@__('editor.move_down')}}</a>
                    </div>

                    <div>
                        @if($component->type == 'text-component')
                            <x-Components.text-component :component="$component"/>
                        @elseif($component->type == 'image-component')
                            <x-Components.image-component :component="$component"/>
                        @endif
                    </div>
                </div>
                </div>
            @endforeach

            <div class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-lg">

                <h1 class="text-3xl text-center font-bold p-2">{{@__('editor.add_component_title')}}</h1>

                <form enctype="multipart/form-data" action="/landing/editor/add" method="POST">
                    @csrf

                    <select name="type" onchange="show()" id="select" class="text-slate-950 w-full p-2 rounded-lg">
                        <option value="none" selected>{{@__('editor.select_type')}}</option>
                        @foreach(\App\enum\ComponentType::cases() as $type)
                            <option dusk="{{$type->getLabel()}}" class="text-slate-950" value="{{$type}}">{{$type->getLabel()}}</option>
                        @endforeach
                    </select>

                    <div id="text-component" class="hidden">
                        <div class="">
                            <p>{{@__('editor.text')}}</p>
                            <input dusk="text-input" name="text" type="text" class="text-slate-950 w-full p-2 rounded-lg">
                        </div>

                        <div class="">
                            <p>{{@__('editor.font_size')}}</p>
                            <input min="12" max="72" name="size" type="number"
                                   class="text-slate-950 w-full p-2 rounded-lg">
                        </div>
                    </div>

                    <div id="image-component" class="hidden">
                        <p>{{@__('editor.image')}}</p>
                        <input name="image" type="file" class="text-slate-950 w-full p-2 rounded-lg bg-white"/>

                        <p>{{@__('editor.description')}}</p>
                        <input type="text" name="description" class="w-full p-2 rounded-lg">
                    </div>

                    @error('type')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-center p-4">
                        <input dusk="add-component" class="p-3 bg-red-500 text-white text-bold text-center rounded-lg" type="submit"
                               value="{{@__('editor.submit_button')}}">
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-lg">

                <h1 class="text-3xl text-center font-bold p-2">{{@__('editor.color')}}</h1>

                <form action="/landing/editor/colors" method="POST">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <div class="">
                            <p>{{@__('editor.color')}}</p>
                            <input name="color" type="color" class="p-0 m-0 w-10 h-10 outline-none border-0">
                        </div>
                    </div>

                    <div class="flex justify-center p-4">
                        <input class="p-3 bg-red-500 text-white text-bold text-center rounded-lg" type="submit"
                               value="{{@__('editor.submit_button')}}">
                    </div>
                </form>

                <x-utils.back-button />
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
