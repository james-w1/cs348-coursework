<!doctype HTML>
<head>
    @livewireStyles
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    @livewireScripts
    <div class="flex sticky top-0 bg-primary-300 h-10 w-full">
        <h3
            class="p-2 text-secondary-600 flex-grow"
        >
            <a
                class="hover:text-primary-400"
                href="{{ route('forum.index') }}"
            >
                forum
            </a>
            @yield('header')
        </h3>
        @if (Auth::user())
            <a 
                class="p-2 text-secondary-600 hover:text-primary-400"
                href="{{ route('profile.show', ['user'=>Auth::user()]) }}"
            >
                {{ Auth::user()->name }}
            </a>
        @else
            <a 
                class="p-2 text-secondary-600 hover:text-primary-400"
                href="{{ route('login.form') }}"
            >
                login
            </a>
            <a 
                class="p-2 text-secondary-600 hover:text-primary-400"
                href="{{ route('register.create') }}"
            >
                register
            </a>
        @endif
    </div>

    <div class="h-screen p-2 bg-primary-100">
        @yield('content')
        <!--
        <div class="w-screen bg-primary-200">
            <p>footer</p>
        </div>
        -->
    </div>
</body>
