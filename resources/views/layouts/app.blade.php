<!doctype HTML>
<head>
    @livewireStyles
    <title>My Forum | @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    @livewireScripts
    <div class="flex bg-slate-300 h-10 w-full">
        <h3 class="px-2 py-2 text-sky-600 hover:text-black"><a href="{{ route('forum.index') }}">forum</a>@yield('header')</h3>
    </div>

    <div class="h-page p-2 bg-slate-200">@yield('content')</div>
</body>
