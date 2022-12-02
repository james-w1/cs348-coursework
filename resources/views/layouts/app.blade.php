<!doctype HTML>
<head>
    <title>My Forum | @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h3><a href="{{ route('forum.index') }}">forum</a>@yield('header')</h3>
    <hr>

    <div>@yield('content')</div>
</body>
