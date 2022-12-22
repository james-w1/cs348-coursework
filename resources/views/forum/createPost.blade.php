@extends('layouts.app')

@section('title', '/Create Post')

@section('header', '/Create Post')
    

@section('content')

<div class="p-2 space-x-2 w-full flex">
    <a 
        class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100" 
        href="{{ route('forum.show', ['sub_forum'=>$sub_forum]) }}"
    >
        back
    </a>
</div>


<div class="flex items-center justify-center">
    <div class="bg-primary-200 flex rounded-md p-2">
        <form class="px-2 space-y-2" method="POST" rows="4" action=" {{ route('forum.store', ['sub_forum'=>$sub_forum]) }}">
            @csrf
            <p>Title: 
                <input class="p-1 rounded-md bg-primary-100" type="text" name="title" value="{{ old('title') }}">
            </p>
            <p>Body:</p> 
                <input class="p-1 rounded-md bg-primary-100 h-auto w-full" type="text" name="body" value="{{ old('body') }}">
            <p>UserID: 
                <input class="p-1 rounded-md bg-primary-100" type="text" name="user_id" value="{{ old('user_id') }}">
            </p>
            <input type="hidden" name="sub_forum_id" value="{{ $sub_forum->id }}">

            <div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
            <div class="flex items-center justify-center w-full">
                <input 
                    class="p-2 rounded-md bg-primary-100 hover:bg-secondary-300 hover:text-primary-100" 
                    type="submit" 
                    value="Submit"
                >
            </div>
        </form>
    </div>
</div>

@endsection
