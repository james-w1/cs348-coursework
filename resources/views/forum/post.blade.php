@extends('layouts.app')

@section('title', '- post: ' . $post->title)

@section('content')
    <p> {{ $post->title }} </p>
    <p> {{ $post->body }} </p>
    <hr>

    <p>replies:</p>
    <div class="container">
    @foreach($replies as $reply)
        <div style="border: 2px solid black;">
            <p>{{ $reply->body }} - {{ $post->created_at }}</p>
        </div>
    @endforeach
    </div>

    {{ $replies->links() }}

    <a href="{{ route('forum.show', ['id' => $subForum->id]) }}">back</a>

@endsection
