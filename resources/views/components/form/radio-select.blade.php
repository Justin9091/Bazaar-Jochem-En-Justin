@foreach($options as $option)
    <div class="flex flex-col justify-center">
        <label for="{{$option}}" class="">
            <div class="{{$card}}">{{$option}}</div>
        </label>
        <input name="value" type="radio"
               value="{{$option}}" {{ $selected == $option ? 'checked' : '' }}/>
    </div>
@endforeach
