<button id="backButton" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Terug</button>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const backButton = document.getElementById("backButton");

        if (backButton) {
            backButton.addEventListener("click", function() {
                window.history.back();
            });
        }
    });
</script>
