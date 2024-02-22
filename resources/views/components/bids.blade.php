<div class="w-25">

    <p>Expires at: {{$advertisement['expires_at']}}</p>

    <x-form action="/bid/{{$advertisement['id']}}">
        @if(auth()->check())
            <x-text-input name="bid" placeholder="Bidding"/>
            <input type="submit" class="{{$button}}">
        @else
            Login to bid
        @endif

    </x-form>

    @foreach($advertisement->bids as $bid)
        <div class="flex justify-between">
            <p>{{$bid["user"]["name"]}}</p>

            <i>{{$bid["bid"]}}</i>
        </div>
    @endforeach
</div>
