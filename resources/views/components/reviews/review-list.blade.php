<div class="reviews-list">
    <h2 class="text-xl font-semibold p-3">@lang('reviews.reviews')</h2>
    <x-reviews.add-review :userid="$userid" :adid="$adid"></x-reviews.add-review>
    @if ($reviews->isEmpty())
        <p class="text-white bg-gray-800 rounded-lg p-4">@lang('reviews.no_reviews')</p>
    @else
        <ul>
            @foreach ($reviews as $review)
                <x-reviews.review :title="$review->title" :description="$review->description" :score="$review->score" :reviewer="$review->reviewer" :date="$review->date"/>
            @endforeach
        </ul>
    @endif
</div>
