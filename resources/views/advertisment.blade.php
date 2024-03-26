@extends('layouts.main')

@section('page-title', $ad["title"])

@section("main-content")
    <div class="p-3">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openPopup({{ $ad->id }})">Rent Item</button>
    </div>
    <div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-gray-600 rounded-lg p-8 relative">
            <span class="bg-red-500 rounded-full text-white absolute top-0 right-0 cursor-pointer w-8 h-8 flex items-center justify-center" onclick="closePopup()">&times;</span>
            <x-form id="rentForm" action="{{ route('rentitem', ['id' => $ad->id]) }}" method="POST">
                <div class="mb-4">
                    <label for="fromDate" class="block">From Date:</label>
                    <input type="date" id="fromDate" name="fromDate" required class="block w-full rounded-md bg-gray-600 border-gray-900">
                </div>
                <div class="mb-4">
                    <label for="toDate" class="block">To Date:</label>
                    <input type="date" id="toDate" name="toDate" required class="block w-full rounded-md bg-gray-600 border-gray-900">
                </div>
                <input type="hidden" id="adId" name="adId" value="{{$ad->id}}">
                <div class="flex justify-center">
                    <button type="submit" class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded border border-blue-700">Submit</button>
                </div>
            </x-form>
        </div>
    </div>

    <div class="w-full flex gap-3">
        <x-bids :advertisement="$ad" />

        <div class="w-3/4">
            <h1 class="text-4xl my-3">{{$ad["title"]}}</h1>
            <p>{{$ad["description"]}}</p>
        </div>
    </div>

    <div class="p-3">
        <x-backbutton></x-backbutton>
    </div>
    <script>
        function openPopup(adId) {
            document.getElementById("adId").value = adId;
            document.getElementById("popup").classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById("popup").classList.add('hidden');
        }

        document.getElementById("rentForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            const adId = formData.get("adId");
            const fromDate = formData.get("fromDate");
            const toDate = formData.get("toDate");
            const url = "{{ url('advertisment') }}/" + adId + "/rentitem";

            window.location.href = url + `?fromDate=${fromDate}&toDate=${toDate}`;
        });

    </script>
@endsection
