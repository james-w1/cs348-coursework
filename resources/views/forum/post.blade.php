@extends('layouts.app')

@section('title', '- post: ' . $post->title)

@section('content')
    <p> {{ $post->title }} </p>
    <p> {{ $post->body }} </p>
    <hr>

    <div class="container">
    <p>replies:</p>
    @foreach($replies as $reply)
        <div style="border: 2px solid black;">
            <p>{{ $reply->body }} - {{ $post->created_at }}</p>
        </div>
    @endforeach
    </div>

    {{ $replies->links() }}

    <a href="{{ route('forum.show', ['id' => $subForum->id]) }}">back</a>

@endsection
