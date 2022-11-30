<!doctype HTML>
<head>
    <title>My Forum @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h3><a href="{{ route('forum.index') }}">My Forum</a> @yield('title')</h3>
    <hr>

    <div>@yield('content')</div>
</body>
