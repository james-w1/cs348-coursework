@extends('layouts.app')

@section('title', '')

@section('content')

    <p>Subforums:</p>
    <ul>
    @foreach($subForums as $subForum)
        <li><a href=" {{ route('forum.show', ['id' => $subForum->id]) }} ">{{ $subForum->name }}</a> - posts: {{ $subForum->posts()->count() }} </li>
    @endforeach
    </ul>

@endsection
