@extends('layouts.app')

@section('title', $sub_forum->name)

@section('header', '/' . $sub_forum->name)

@section('content')

    <a href="{{ route('post.create', ['sub_forum' => $sub_forum]) }}">Create Post</a>
    
    <ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('post.show', ['sub_forum' => $sub_forum, 'post' => $post]) }}">
                {{ $post->title }}
            </a>
               - {{ Str::limit($post->body, 30) }} - {{ $post->reply->count() }} replies
        </li>
    @endforeach
    </ul>

    <a href="{{ route('forum.index') }}">back</a>

@endsection
