@extends('layouts.app')

@section('title', '')

@section('header', '')

@section('content')

    <!-- <livewire:counter />-->


    <p>Subforums:</p>
    <ul>
    @foreach($sub_forums as $sub_forum)
        <li><a href=" {{ route('forum.show', ['sub_forum' => $sub_forum]) }} ">{{ $sub_forum->name }}</a> - posts: {{ $sub_forum->posts()->count() }} </li>
    @endforeach
    </ul>

@endsection
