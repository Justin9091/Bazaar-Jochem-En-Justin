<div class="p-2">
    <input type="{{$type}}" placeholder="{{$placeholder}}" name="{{$name}}" class="p-2 rounded-lg"
           value="{{$value}}"/>
    <p class="text-red-500">{{ $errors->first($name) }}</p>
</div>
