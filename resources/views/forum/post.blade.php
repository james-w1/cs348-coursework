@extends('layouts.app')

@section('title', '- ' . $post->name)

@section('content')
    <p> {{ $post->name }} </p>
    <p> {{ $post->body }} </p>
    <hr>

    <p>replies:</p>
    @foreach($replies as $reply)
        <p>{{ $reply->body }} - {{ $post->created_at }}</p>
        <hr>
    @endforeach

    <a href="{{ route('forum.show', ['id' => $subForum->id]) }}">back</a>

@endsection
