@extends('layouts.app')

@section('title', $sub_forum->name)

@section('header', '/' . $sub_forum->name)

@section('content')

    <a class="rounded-md bg-primary-200 p-2 hover:bg-secondary-300 hover:text-primary-100" href="{{ route('post.create', ['sub_forum' => $sub_forum]) }}">Create Post</a>
    
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
                <p>{{ $post->reply->count() }} replies</p>
            </div>
        </li>
    @endforeach
    </ul>

    <a class="rounded-md bg-primary-200 p-2 hover:bg-secondary-300 hover:text-primary-100" href="{{ route('forum.index') }}">back</a>

@endsection
