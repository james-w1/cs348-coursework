@extends('layouts.app')

@section('title', '/profile/' . $user->name)

@section('header', '/profile/' . $user->name)

@section('content')
    <div class="p-2 space-x-2 flex w-full">
        <a 
            class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
            href="{{ route('forum.index') }}"
        >
            back
        </a>
    @if (Auth::user())
        @if (Auth::user()->id == $user->id )
                <a 
                    class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
                    href="{{ route('profile.settings', ['user'=>Auth::user()]) }}"
                >
                    settings
                </a>
                <livewire:logout />
        @endif
    @endif
    </div>

    <div 
        class="p-1 flex flex-col items-center justify-center bg-primary-200 rounded-md overflow-y-scroll"
    >
        <p> {{ $user->name }}'s Posts:</p>
        <div class="rounded-md w-full px-20">
            <ul role="list" class="p-2 space-y-2">
                @foreach($posts as $post)
                    <li class="bg-primary-100 p-2 rounded-md">
                        <div class="w-full">
                            <span>
                                <a
                                    class="text-secondary-500 hover:text-black"
                                    href=""
                                >
                                    {{ $post->title }}
                                </a> 
                                in $subforum->name
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $posts->links() }}
        </div>
    </div>
    
    <br>
    
    <div 
        class="p-1 flex flex-col items-center justify-center bg-primary-200 rounded-md overflow-y-scroll"
    >
        <p> {{ $user->name }}'s Replies:</p>
        <div class="rounded-md w-full px-20">
            <ul role="list" class="p-2 space-y-2">
                @foreach($replies as $reply)
                    <li class="bg-primary-100 p-2 rounded-md">
                        <div class="w-full">
                            <span>
                                <a
                                    class="text-secondary-500 hover:text-black"
                                    href=""
                                >
                                    {{ Str::limit($reply->body, 32) }}
                                </a> 
                                in $post->name
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $replies->links() }}
        </div>
    </div>
    
@endsection
