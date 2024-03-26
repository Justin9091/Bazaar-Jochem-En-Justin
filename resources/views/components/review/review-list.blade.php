<div class="reviews-list">
    <h2 class="text-xl font-semibold p-3">Reviews</h2>
    <x-add-review :userid="$userid" reviewer="verander nog ooit" :adid="$adid"></x-add-review>
    @if ($reviews->isEmpty())
        <p class="text-white bg-gray-800 rounded-lg p-4">Geen reviews voor deze verkoper</p>
    @else
        <ul>
            @foreach ($reviews as $review)
                <x-review :title="$review->title" :description="$review->description" :score="$review->score" :reviewer="$review->reviewer" :date="$review->date"/>
            @endforeach
        </ul>
    @endif
</div>
