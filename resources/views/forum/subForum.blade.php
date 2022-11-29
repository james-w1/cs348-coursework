@extends('layouts.app')

@section('title', '- ' . $subForum->name)

@section('content')

    <p>postcount: {{ $posts->count() }}</p>
 
    <p>Posts:</p>
    <ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('post.show', ['id' => $subForum->id, 'pid' => $post->id]) }}">
                {{ $post->title }}
            </a>
               - {{ $post->body }} - {{ $post->created_at }}
        </li>
    @endforeach
    </ul>

    <a href="{{ route('forum.index') }}">back</a>

@endsection
