@extends('layouts.app')

@section('title', '')

@section('header', '')

@section('content')
    <ul role="list" class=" p-2 space-y-2">
    @foreach($sub_forums as $sub_forum)
        <li class="flex bg-primary-200 p-2 rounded-md">
            <div class="">
                <a class="text-secondary-500 hover:text-primary-400" href=" {{ route('forum.show', ['sub_forum' => $sub_forum]) }} ">{{ $sub_forum->name }}</a>
                <p class="text-sm">posts: {{ $sub_forum->posts()->count() }}</p>
            </div>
        </li>
    @endforeach
    </ul>

    {{ $sub_forums->links() }}

@endsection
