@extends('layouts.app')

@section('title', '/Create Post')

@section('header', '/Create Post')
    

@section('content')

<form method="POST" action=" {{ route('forum.store', ['id'=>$subForum->id]) }}">
    @csrf
    <p>Title: <input type="text" name="{{ old('title') }}"></p>
    <p>Body: <input type="text" name="{{ old('body') }}"></p>
    <p>UserID: <input type="text" name="{{ old('user_id') }}"></p>
    <input type="hidden" name="sub_forum_id" value="{{ $subForum->id }}">

    <input type="submit" value="Submit">
</form>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color: red;">{{ $error }}</p>
    @endforeach
@endif

@endsection
