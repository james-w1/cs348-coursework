@extends('layouts.app')

@section('title', $subForum->name)

@section('header', '/' . $subForum->name)

@section('content')

    <a href="{{ route('post.create', ['sub_forum' => $subForum]) }}">Create Post</a>
    
    <ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('post.show', ['sub_forum' => $subForum, 'post' => $post]) }}">
                {{ $post->title }}
            </a>
               - {{ Str::limit($post->body, 30) }} - {{ $post->reply->count() }} replies
        </li>
    @endforeach
    </ul>

    <a href="{{ route('forum.index') }}">back</a>

@endsection
