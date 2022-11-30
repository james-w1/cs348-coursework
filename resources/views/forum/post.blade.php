@extends('layouts.app')

@section('title', '- forum:' . $subForum->name . ' post: ' . $post->title)

@section('content')
    <p> {{ $post->title }} </p>
    <p> {{ $post->body }} </p>
    <hr>

    <div class="container">
    <p>replies:</p>
    @foreach($replies as $reply)
        <div style="padding: 2px; border: 2px solid black;">
            <p>{{ $reply->body }}</p>
            <p style="font-size: 9px;">Posted On: {{ $post->created_at }}</p>
        </div>
    @endforeach
    </div>

    {{ $replies->links() }}

    <a href="{{ route('forum.show', ['id' => $subForum->id]) }}">back</a>

@endsection
