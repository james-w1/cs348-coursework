<!doctype HTML>
<head>
    @livewireStyles
    <title>My Forum | @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    @livewireScripts
    <div class="flex bg-primary-200 h-10 w-full">
        <h3 class="p-2 text-secondary-600 hover:text-primary-400"><a href="{{ route('forum.index') }}">forum</a>@yield('header')</h3>
    </div>

    <div class="h-screen p-2 bg-primary-100">@yield('content')</div>
</body>
