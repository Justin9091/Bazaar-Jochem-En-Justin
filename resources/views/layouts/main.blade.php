<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title') | De Bazaar</title>

    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/inbox.css' rel='stylesheet'>
</head>
<body>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="bg-slate-100 dark:bg-slate-600 min-h-screen mix-blend-multiply text-black dark:text-white">
    <header class="bg-white dark:bg-slate-700 flex justify-between p-4 shadow-lg px-32">
        <ul class="m-2">
            <li><a href="/">LOGO</a></li>
        </ul>

        <ul class="flex gap-3 m-2">
            <x-language-switcher/>

            @if(auth()->check())
                <li><a href="/logout">Logout</a></li>
                <i class="gg-inbox"></i>
                <li><a href="/account">Account</a></li>
            @else
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            @endif
        </ul>
    </header>

    <div class="px-32 py-3">
        @yield("main-content")
    </div>
</div>

</body>
</html>
