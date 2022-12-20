@extends('layouts.app')

@section('title', $sub_forum->name)

@section('header', '/' . $sub_forum->name)

@section('content')

    <a class="" href="{{ route('post.create', ['sub_forum' => $sub_forum]) }}">Create Post</a>
    
    <ul role="list" class="bg-slate-200 p-2 space-y-2">
    @foreach($posts as $post)
        <li class="bg-slate-50 p-2 rounded-md">
            <div class="text-lg w-full">
                <a class="text-sky-500 hover:text-black" href="{{ route('post.show', ['sub_forum' => $sub_forum, 'post' => $post]) }}">
                    {{ $post->title }}
                </a>
            </div>
            <div class="text-sm">
                <p>{{ Str::limit($post->body, 30) }}</p> 
                <p>{{ $post->reply->count() }} replies</p>
            </div>
        </li>
    @endforeach
    </ul>

    <a href="{{ route('forum.index') }}">back</a>

@endsection
