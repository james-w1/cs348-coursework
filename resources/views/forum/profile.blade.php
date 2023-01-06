@extends('layouts.app')

@section('title', '/ profile / ' . $user->name)

@section('header', '/ profile / ' . $user->name)

@section('content')
    <div class="pb-2 space-x-2 flex w-full">
        <a 
            class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
            href="{{ url()->previous() }}"
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
            <div class="max-h-64 overflow-y-scroll">
                <ul role="list" class="p-2 space-y-2">
                    @foreach($posts as $post)
                        <li class="bg-primary-100 p-2 rounded-md">
                            <div class="w-full flex">
                                <div class="flex-grow">
                                    <a
                                        class="text-secondary-500 hover:text-black"
                                        href="{{ route('post.show', ['post'=>$post, 'sub_forum'=>$post->SubForum]) }}"
                                    >
                                        {{ $post->title }}
                                    </a> 
                                    in
                                    <a
                                        class="text-secondary-500 hover:text-black"
                                        href="{{ route('forum.show', ['sub_forum'=>$post->SubForum]) }}"
                                    >
                                        {{ $post->SubForum->name }}
                                    </a> 
                                </div>
                                <div>
                                    <p class="text-sm text-primary-500">
                                        Replies: {{ $post->reply->count() }} | {{ $post->created_at }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <br>
    
    <div 
        class="p-1 flex flex-col items-center justify-center bg-primary-200 rounded-md overflow-y-scroll"
    >
        <p> {{ $user->name }}'s Replies:</p>
        <div class="rounded-md w-full px-20">
            <div class="max-h-64 overflow-y-scroll">
                <ul role="list" class="p-2 space-y-2">
                    @foreach($replies as $reply)
                        <li class="bg-primary-100 p-2 rounded-md">
                            <div class="flex w-full">
                                <div class="flex-grow">
                                    <span
                                        class="text-secondary-500 hover:text-black"
                                    >
                                        {{ Str::limit($reply->body, 32) }}
                                    </span> 
                                    in
                                    <a
                                        class="text-secondary-500 hover:text-black"
                                        href="{{ route('post.show', ['post'=>$reply->Post, 'sub_forum'=>$reply->Post->SubForum]) }}"
                                    >
                                        {{ $reply->Post->title }}
                                    </a> 
                                </div>
                                <div class="">
                                    <p class="text-sm text-primary-500">
                                        {{ $reply->created_at }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
@endsection
