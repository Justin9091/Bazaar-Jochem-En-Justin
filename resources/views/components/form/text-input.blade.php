<div class="{{$padding}}">
    <input type="{{$type}}" placeholder="{{$placeholder}}" name="{{$name}}" class="{{$secondary_text}} {{$padding}}"
           value="{{$value}}"/>
    <p class="text-red-500">{{ $errors->first($name) }}</p>
</div>
