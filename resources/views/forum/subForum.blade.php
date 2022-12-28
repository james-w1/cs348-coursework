@extends('layouts.app')

@section('title', $sub_forum->name)

@section('header')
    <span>
        / <a class="hover:text-primary-400" href="{{ route('forum.show', ['sub_forum'=>$sub_forum]) }}">{{ $sub_forum->name }}</a>
    </span>
@endsection

@section('content')

    <div class="w-full p-2">
        <a class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100" href="{{ route('forum.index') }}">back</a>
        @if (Auth::user())
            <a class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100" href="{{ route('post.create', ['sub_forum' => $sub_forum]) }}">Create Post</a>
        @endif
    </div>
    
    <ul role="list" class="bg-primary-100 p-2 space-y-2">
    @foreach($posts as $post)
        <li 
            @if (Auth::user())
                @if (Auth::user()->id == $post->user_id)
                    class="bg-primary-300 p-2 rounded-md"
                @endif
            @endif
            class="bg-primary-200 p-2 rounded-md"
        >
            <div class="flex justify-between text-lg w-full">
                <a
                    class="text-secondary-500 hover:text-primary-400" 
                    href="{{ route('post.show', ['sub_forum' => $sub_forum, 'post' => $post]) }}"
                >
                    {{ $post->title }}
                </a>
                    @if (Auth::user())
                        @if (Auth::user()->id == $post->user_id)
                            <div class="order-last flex space-x-2 text-sm text-secondary-700">
                                <a class="hover:underline hover:text-secondary-500" href="#">edit</a>
                                <a class="hover:underline hover:text-secondary-500" href="#">remove</a>
                            </div>
                        @endif
                    @endif
            </div>
            <div class="text-sm">
                <p>{{ Str::limit($post->body, 100) }}</p> 
                <div class="flex text-primary-500 justify-between w-full">
                    <p>{{ $post->reply->count() }} replies</p>
                    <p class="order-last">
                        Posted By: {{ $post->user_id }} | Posted On: {{ $post->created_at }}
                    </p>
                </div>
            </div>
        </li>
    @endforeach
    </ul>

    {{ $posts->links() }}

@endsection
