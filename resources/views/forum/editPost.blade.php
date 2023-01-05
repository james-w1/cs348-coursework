@extends('layouts.app')

@section('title', 'Edit')

@section('header', '/ Edit')
    

@section('content')

<div class="pb-2 space-x-2 w-full flex">
    <a 
        class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100" 
        href="{{ route('forum.show', ['sub_forum'=>$sub_forum]) }}"
    >
        back
    </a>
</div>


<div 
    class="flex items-center justify-center"
>
    <div 
        class="bg-primary-200 flex rounded-md p-2"
    >
        <form 
            class="px-2 space-y-2" 
            method="POST" 
            rows="4" 
            action=" {{ route('post.update', ['sub_forum'=>$sub_forum, 'post'=>$post]) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')
            <div>
                <p class="text-primary-600">Title</p>
                <input 
                    class="p-1 rounded-md bg-primary-100 w-full"
                    type="text" 
                    name="title" 
                    value="{{ $post->title }}"
                >
            </div>

            <div>
                <p class="text-primary-600">Body</p> 
                <textarea 
                    class="p-1 rounded-md bg-primary-100 w-full"
                    name="body" 
                >{{ $post->body }}</textarea>
            </div>

            <div
            >
                <p class="text-primary-600">Image (optional)</p>
                <input
                    class="p-1 rounded-md bg-primary-100 w-full text-primary-600"
                    type="file"
                    name="image"
                    value="{{ $post->image_path }}"
                >
                </input>
            </div>

            <input 
                type="hidden" 
                name="user_id" 
                value="{{ Auth::user()->id }}"
            >
            </input>

            <input 
                type="hidden" 
                name="sub_forum_id" 
                value="{{ $sub_forum->id }}"
            >
            </input>

            <div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-other-red">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
            <div 
                class="flex items-center justify-center w-full"
            >
                <input 
                    class="p-2 text-primary-600 rounded-md bg-primary-100 hover:bg-secondary-300 hover:text-primary-100" 
                    type="submit" 
                    value="Submit"
                >
                </input>
            </div>
        </form>
    </div>
</div>

@endsection
