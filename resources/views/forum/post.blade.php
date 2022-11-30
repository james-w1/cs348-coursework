@extends('layouts.app')

@section('title', $subForum->name . '/' . $post->title)

@section('header', '/' . $subForum->name . '/' . $post->title)
    

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

    
    <p> Quick Reply: </p>
    <form method="POST" action=" {{ route('post.reply', ['id'=>$subForum->id, 'pid'=>$post->id]) }}">
        @csrf
        <p>Body: <input type="text" name="body"></p>
        <p>UserID: <input type="text" name="userID"></p>
        <input type="hidden" name="postID" value="{{ $post->id }}">
    
        <input type="submit" value="Submit">
    </form>
    
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
    @endif


    <a href="{{ route('forum.show', ['id' => $subForum->id]) }}">back</a>

@endsection
