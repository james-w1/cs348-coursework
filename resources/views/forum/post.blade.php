@extends('layouts.app')

@section('title', $sub_forum->name . '/' . $post->title)

@section('header', '/' . $sub_forum->name . '/' . $post->title)
    

@section('content')
    <p> {{ $post->title }} </p>
    <p> {{ $post->body }} </p>
    <p style="font-size: 9px;">Posted By: {{ $op->name }} | Posted On: {{ $post->created_at }}</p>
    <hr>

    <div class="container">
    <p>replies:</p>
    @foreach($replies as $reply)
        <div style="padding: 2px; border: 2px solid black;">
            <p>{{ $reply->body }}</p>
            <p style="font-size: 9px;">Posted By: | Posted On: {{ $reply->created_at }}</p>
        </div>
    @endforeach
    </div>

    {{ $replies->links() }}

    @livewire('quick-reply', ['sub_forum'=>$sub_forum, 'post' => $post])

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
    @endif

    <a href="{{ route('forum.show', ['sub_forum' => $sub_forum]) }}">back</a>

@endsection
