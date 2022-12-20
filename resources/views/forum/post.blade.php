@extends('layouts.app')

@section('title', $sub_forum->name . '/' . $post->title)

@section('header', '/' . $sub_forum->name . '/' . $post->title)
    

@section('content')
    <div class="bg-primary-200 p-2 rounded-md">
        <p class="text-lg"> {{ $post->title }} </p>
        <p class=""> {{ $post->body }} </p>
        <div class="flex flex-row-reverse">
            <p class="text-primary-500 text-sm">Posted By: {{ $op->name }} | Posted On: {{ $post->created_at }}</p>
        </div>
    </div>

    <div class="">
        @livewire('quick-reply', ['sub_forum'=>$sub_forum, 'post' => $post])
    </div>

    <div class="p-4 space-y-2">
        @foreach($replies as $reply)
            <div class="p-2 bg-primary-200 rounded-md space-y-2">
                <p>{{ $reply->body }}</p>
                <div class="flex flex-row-reverse">
                    <p class="text-sm text-primary-500">
                        Posted By: {{ $repliers[$reply->id]->name }} | Posted On: {{ $reply->created_at }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    {{ $replies->links() }}


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
    @endif

    <a class="rounded-md bg-primary-200 p-2 hover:bg-secondary-300 hover:text-primary-100" href="{{ route('forum.show', ['sub_forum' => $sub_forum]) }}">back</a>

@endsection
