@extends('layouts.main')

@section('main-content')
    <div class="container">

        <div class="flex flex-col gap-2">
            @foreach($components as $component)

                <div class="bg-white dark:bg-gray-800 rounded-lg p-3 flex justify-between items-center shadow-lg">

                    <div class="flex flex-col gap-2">
                        <a class="p-1 bg-blue-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/up/{{$component->id}}">{{@__('editor.move_up')}}</a>
                        <a class="p-1 bg-red-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/remove/{{$component->id}}">{{@__('editor.delete')}}</a>
                        <a class="p-1 bg-blue-500 text-white text-bold text-center rounded-lg"
                           href="/landing/editor/down/{{$component->id}}">{{@__('editor.move_down')}}</a>
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

            <div class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-lg">

                <h1 class="text-3xl text-center font-bold p-2">{{@__('editor.add_component_title')}}</h1>

                <form enctype="multipart/form-data" action="/landing/editor/add" method="POST">
                    @csrf

                    <select name="type" onchange="show()" id="select" class="text-slate-950 w-full p-2 rounded-lg">
                        <option value="none" selected>{{@__('editor.select_type')}}</option>
                        @foreach(\App\enum\ComponentType::cases() as $type)
                            <option class="text-slate-950" value="{{$type}}">{{$type->getLabel()}}</option>
                        @endforeach
                    </select>

                    <div id="text-component" class="hidden">
                        <div class="">
                            <p>{{@__('editor.text')}}</p>
                            <input name="text" type="text" class="text-slate-950 w-full p-2 rounded-lg">
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
                        <input class="p-3 bg-red-500 text-white text-bold text-center rounded-lg" type="submit"
                               value="{{@__('editor.submit_button')}}">
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-3 shadow-lg">

                <h1 class="text-3xl text-center font-bold p-2">{{@__('editor.colors')}}</h1>

                <form action="/landing/editor/colors" method="POST">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <div class="flex gap-2">
                            <p>{{@__('editor.background_color')}}</p>
                            <input name="background_color" type="color" class="text-slate-950 w-full p-2 rounded-lg">
                        </div>

                        <div class="flex gap-2">
                            <p>{{@__('editor.text_color')}}</p>
                            <input name="text_color" type="color" class="text-slate-950 w-full p-2 rounded-lg">
                        </div>
                    </div>

                    <div class="flex justify-center p-4">
                        <input class="p-3 bg-red-500 text-white text-bold text-center rounded-lg" type="submit"
                               value="{{@__('editor.submit_button')}}">
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