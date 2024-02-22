<div class="bg-blue-400 px-5">
    @foreach($languages as $key => $value)
        <a href="/language/{{$key}}">{{$value}}</a>
    @endforeach
</div>


