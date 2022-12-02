@extends('layouts.app')

@section('title', '')

@section('header', '')

@section('content')

    <p>Subforums:</p>
    <ul>
    @foreach($subForums as $subForum)
        <li><a href=" {{ route('forum.show', ['sub_forum' => $subForum]) }} ">{{ $subForum->name }}</a> - posts: {{ $subForum->posts()->count() }} </li>
    @endforeach
    </ul>

@endsection
