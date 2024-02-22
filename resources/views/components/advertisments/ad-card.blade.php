<a href="/advertisment/{{$ad["id"]}}">
    <div class="{{$card}}">
        <h3>{{$ad["title"]}}</h3>
        <p>{{$ad["description"]}}</p>
    </div>
</a>

<x-favorite-star :ad="$ad" />
