<a href="/advertisment/{{$ad["id"]}}" class="block {{$card}} border border-gray-700 rounded-lg hover:shadow-lg transition duration-300 ease-in-out">
    <div class="p-4">
        <h3 class="text-lg font-semibold mb-2">{{$ad["title"]}}</h3>
        <p class="text-gray-600">{{$ad["description"]}}</p>
    </div>
</a>

<x-favorite-star :ad="$ad" class="ml-4"/>
