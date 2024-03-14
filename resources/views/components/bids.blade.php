<div class="w-1/4 bg-gray-600 p-4 border border-gray-200 rounded-lg shadow-md">
    <p class="text-white">Expires at: {{$advertisement['expires_at']}}</p>

    <x-form action="/bid/{{$advertisement['id']}}">
        @if(auth()->check())
            <x-text-input name="bid" placeholder="Enter your bid" class="mt-2 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></x-text-input>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Place Bid</button>
        @else
            <p class="mt-2 text-red-500">Login to bid</p>
        @endif
    </x-form>

    @foreach($advertisement->bids as $bid)
        <div class="flex justify-between items-center mt-2">
            <p class="text-white">{{$bid["user"]["name"]}}</p>
            <span class="text-white">{{$bid["bid"]}}</span>
        </div>
    @endforeach
</div>
