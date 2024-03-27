<form action="/language" method="POST" id="lang-form">
    @csrf

    <select name="locale" id="" oninput="updateLanguage()" class="text-black">

        @foreach($languages as $key => $value)
            <option value="{{$key}}" {{ (app()->getLocale() == $key) ? 'selected' : '' }}>{{$value}}</option>
        @endforeach
    </select>
</form>

<script>
    function updateLanguage(e) {
        document.getElementById('lang-form').submit();
    }
</script>


