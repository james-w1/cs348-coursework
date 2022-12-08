@extends('layouts.app')

@section('title', '/Create Post')

@section('header', '/Create Post')
    

@section('content')

<form method="POST" action=" {{ route('forum.store', ['sub_forum'=>$sub_forum]) }}">
    @csrf
    <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
    <p>Body: <input type="text" name="body" value="{{ old('body') }}"></p>
    <p>UserID: <input type="text" name="user_id" value="{{ old('user_id') }}"></p>
    <input type="hidden" name="sub_forum_id" value="{{ $sub_forum->id }}">

    <input type="submit" value="Submit">
</form>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color: red;">{{ $error }}</p>
    @endforeach
@endif

@endsection
