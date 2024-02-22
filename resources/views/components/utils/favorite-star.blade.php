{{-- &#9734; --> Empty star --}}
{{--&#9733; --> Full star --}}

<div class="">
    <a href="/favorite/{{$ad["id"]}}">
        @if($isFavorited)
            <span class="text-yellow-500">&#9733;</span>
        @else
            <span class="text-yellow-500">&#9734;</span>
        @endif
    </a>
</div>
