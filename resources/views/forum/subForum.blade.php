@extends('layouts.app')

@section('title', '- ' . $subForum->name)

@section('content')

    <a href="{{ route('forum.create', ['id' => $subForum->id]) }}">Create Post</a>
    
    <ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('post.show', ['id' => $subForum->id, 'pid' => $post->id]) }}">
                {{ $post->title }}
            </a>
               - {{ Str::limit($post->body, 30) }} - {{ $post->created_at }}
        </li>
    @endforeach
    </ul>

    <a href="{{ route('forum.index') }}">back</a>

@endsection
