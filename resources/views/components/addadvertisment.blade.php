@if(Auth::check() && Auth::id() == $userid)
    <a href="{{ route('sellers.addadvertisement', ['userId' => $userid]) }}" class="block py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">Aanbieding toevoegen</a>
    <p class="text-gray-500">Logged in as: {{ auth()->id() }}</p>
@endif
