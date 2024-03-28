@extends('layouts.main')

@section('page-title', __('ad.title', ['title' => $ad["title"]]))

@section("main-content")
    @if ($ad->type == "rent")
        <div class="p-3">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onclick="openPopup({{ $ad->id }})">@lang('ad.rent_item')</button>
        </div>
        <div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-gray-600 rounded-lg p-8 relative">
                <span
                    class="bg-red-500 rounded-full text-white absolute top-0 right-0 cursor-pointer w-8 h-8 flex items-center justify-center"
                    onclick="closePopup()">&times;</span>
                <x-forms.form id="rentForm" action="{{ route('advertisement.rent', ['id' => $ad->id]) }}" method="POST">
                    <div class="mb-4">
                        <label for="fromDate" class="block">@lang('ad.from_date'):</label>
                        <input type="date" id="fromDate" name="fromDate" required
                               class="block w-full rounded-md bg-gray-600 border-gray-900">
                    </div>
                    <div class="mb-4">
                        <label for="toDate" class="block">@lang('ad.to_date'):</label>
                        <input type="date" id="toDate" name="toDate" required
                               class="block w-full rounded-md bg-gray-600 border-gray-900">
                    </div>
                    <input type="hidden" id="adId" name="adId" value="{{$ad->id}}">
                    <div class="flex justify-center">
                        <button type="submit"
                                class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded border border-blue-700">@lang('ad.submit')</button>
                    </div>
                </x-forms.form>
            </div>
        </div>
    @endif

    <div class="w-full flex gap-3">
        <x-bids :advertisement="$ad"/>

        <div class="w-3/4">
            <h1 class="text-4xl my-3">{{$ad["title"]}}</h1>
            <p>{{$ad["description"]}}</p>
        </div>
    </div>

    <div class="container bg-gray-800 p-3 rounded-lg">
        <h2 class="text-2xl text-center font-bold">{{__('advertisement.related')}}</h2>

        <div class="grid grid-cols-5 gap-4 py-3">
            @foreach($relatedAds as $relAd)
                <div class="">

                    <x-advertisements.ad-card :ad="$relAd"/>


                    @if($ad->user_id == Auth::id())
                        <a href="{{route('related.remove', [$ad->id, $relAd->id])}}">
                            <x-utils.button
                                :type="\App\enum\ButtonType::RED">{{__('advertisement.remove_related')}}</x-utils.button>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        @if($ad->user_id == Auth::id())
            <x-forms.form action="{{route('related.add', $ad->id)}}" method="POST" class="py-3">
                <select name="related_ad_id" class="w-full p-2 rounded-lg text-black">
                    @foreach($allAds as $currAd)
                        @if($currAd->id != $ad->id && !$relatedAds->contains($currAd->id))
                            <option value="{{$currAd->id}}">{{$currAd->title}}</option>
                        @endif
                    @endforeach
                </select>

                <div class="flex justify-center">
                    <x-submit-button value="{{__('advertisement.add_related')}}"/>
                </div>
            </x-forms.form>
        @endif
    </div>

    <x-reviews.review-list :userid="$ad->user_id" :adid="$ad->id" :reviews="$ad->getReviews($ad->id, $ad->user_id)"/>

    <div class="p-3">
        <x-utils.backbutton></x-utils.backbutton>
    </div>
    <script>
        function openPopup(adId) {
            document.getElementById("adId").value = adId;
            document.getElementById("popup").classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById("popup").classList.add('hidden');
        }

        document.getElementById("rentForm").addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            const adId = formData.get("adId");
            const fromDate = formData.get("fromDate");
            const toDate = formData.get("toDate");
            const url = "{{ url('advertisement') }}/" + adId + "/rentitem";

            window.location.href = url + `?fromDate=${fromDate}&toDate=${toDate}`;
        });

    </script>
@endsection
