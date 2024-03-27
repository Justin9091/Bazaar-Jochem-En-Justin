<div class="">
    <div id="backButton">
        <x-utils.button :type="\App\enum\ButtonType::GREEN">{{ __('backbutton.back_button') }}</x-utils.button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const backButton = document.getElementById("backButton");

        if (backButton) {
            backButton.addEventListener("click", function () {
                window.history.back();
            });
        }
    });
</script>
