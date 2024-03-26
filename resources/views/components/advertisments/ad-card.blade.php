<div class="p-3 rounded-lg bg-white dark:bg-gray-800">
    <a href="/advertisment/{{$ad["id"]}}">
        <div class="">
            <h3>{{$ad["title"]}}</h3>
            <p>{{$ad["description"]}}</p>
        </div>
    </a>

    <x-favorite-star :ad="$ad" />
</div>
