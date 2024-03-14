<div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-4 border border-black">
    <h2 class="text-xl font-semibold mb-4">Add Review</h2>
    <form action="{{ route('add_review') }}" method="post" class="form-container">
        @csrf
        <div class="mb-4">
            <label for="score" class="block text-white font-semibold">Score:</label>
            <div class="flex items-center mt-2">
                @for ($i = 1; $i <= 5; $i++)
                    <svg id="star{{$i}}" onclick="setRating({{$i}})" class="w-8 h-8 cursor-pointer @if($i <= 5) text-gray-300 dark:text-gray-500 @else text-yellow-300 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                @endfor
            </div>
        </div>
        <div class="mb-4">
            <label for="title" class="block text-white font-semibold">Title:</label>
            <input type="text" id="title" name="title" class="form-field mt-2 w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-white font-semibold">Description:</label>
            <textarea id="description" name="description" class="form-field mt-2 w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
        </div>
        <input type="hidden" id="score" name="score" class="form-field">
        <input type="hidden" id="reviewer" name="reviewer" value="{{ $reviewer }}" class="form-field">
        <input type="hidden" name="user_id" value="{{ $userid }}">
        <button onclick="submitReview()" type="submit" class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit Review</button>
    </form>
</div>
<script>
    let rating = 0;

    function setRating(value) {
        rating = value;
        highlightStars(value);
    }

    function highlightStars(value) {
        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById(`star${i}`);
            if (i <= value) {
                star.classList.remove("text-gray-300", "dark:text-gray-500");
                star.classList.add("text-yellow-300");
            } else {
                star.classList.remove("text-yellow-300");
                star.classList.add("text-gray-300", "dark:text-gray-500");
            }
        }
    }

    function submitReview() {
        document.getElementById('score').value = rating;
        return true;
    }
</script>
