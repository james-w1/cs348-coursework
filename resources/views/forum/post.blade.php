@extends('layouts.app')

@section('title', $sub_forum->name . '/' . $post->title)

@section('header', '/' . $sub_forum->name . '/' . $post->title)
    

@section('content')
    <div class="bg-slate-50 p-2 rounded-md">
        <p class="text-lg"> {{ $post->title }} </p>
        <p class=""> {{ $post->body }} </p>
        <p class="text-stone-500 text-sm">Posted By: {{ $op->name }} | Posted On: {{ $post->created_at }}</p>
    </div>

    <div class="p-4 space-y-2">
        @foreach($replies as $reply)
            <div class="p-2 bg-slate-50 rounded-md space-y-2">
                <p>{{ $reply->body }}</p>
                <p class="text-sm text-stone-500">
                    Posted By: {{ $repliers[$reply->id]->name }} | Posted On: {{ $reply->created_at }}
                </p>
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
