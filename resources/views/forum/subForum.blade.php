@extends('layouts.app')

@section('title', $sub_forum->name)

@section('header', '/' . $sub_forum->name)

@section('content')

    <div class="w-full p-2">
        <a class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100" href="{{ route('forum.index') }}">back</a>
        <a class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100" href="{{ route('post.create', ['sub_forum' => $sub_forum]) }}">Create Post</a>
    </div>
    
    <ul role="list" class="bg-primary-100 p-2 space-y-2">
    @foreach($posts as $post)
        <li class="bg-primary-200 p-2 rounded-md">
            <div class="text-lg w-full">
                <a class="text-secondary-500 hover:text-black" href="{{ route('post.show', ['sub_forum' => $sub_forum, 'post' => $post]) }}">
                    {{ $post->title }}
                </a>
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


@endsection
