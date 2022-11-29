<!doctype HTML>
<head>
    <title>My Forum @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <span><h3>My Forum @yield('title')</h3></span>
    <hr>

    <div>@yield('content')</div>
</body>
