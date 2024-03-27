<div class="p-2 w-full">
    <input type="{{$type}}" placeholder="{{$placeholder}}" name="{{$name}}" class="p-2 w-full rounded-lg text-black"
           value="{{$value}}"/>
    <p class="text-red-500">{{ $errors->first($name) }}</p>
</div>
