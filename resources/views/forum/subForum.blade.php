@extends('layouts.app')

@section('title', $sub_forum->name)

@section('header')
    <span>
        / <a class="hover:text-primary-400" href="{{ route('forum.show', ['sub_forum'=>$sub_forum]) }}">{{ $sub_forum->name }}</a>
    </span>
@endsection

@section('content')

    <div class="space-x-2 w-full pl-2">
        <a 
            class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100"
            href="{{ route('forum.index') }}"
        >
            Back
        </a>
        @if (Auth::user())
            <a
                class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100" 
                href="{{ route('post.create', ['sub_forum' => $sub_forum]) }}"
            >
                Create Post
            </a>
        @endif
    </div>
    
    <ul role="list" class="bg-primary-100 p-2 space-y-2">
    @foreach($posts as $post)
        <li 
            @if (Auth::user())
                @if (Auth::user()->id == $post->user_id)
                    class="bg-primary-300 rounded-md"
                @endif
            @endif
            class="bg-primary-200 rounded-md"
        >
            <div class="px-1 flex justify-between text-lg w-full">
                <a
                    class="text-secondary-500 hover:text-primary-400" 
                    href="{{ route('post.show', ['sub_forum' => $sub_forum, 'post' => $post]) }}"
                >
                    {{ $post->title }}
                </a>
                    @if (Auth::user())
                        @if (Auth::user()->id == $post->user_id)
                            <div class="order-last flex space-x-2 text-sm text-secondary-700">
                                <a 
                                    class="hover:underline hover:text-secondary-500" 
                                    href="#"
                                >
                                    edit
                                </a>
                                <a 
                                    class="hover:underline hover:text-secondary-500" 
                                    href="#"
                                >
                                    remove
                                </a>
                            </div>
                        @endif
                    @endif
            </div>
            
            <div
                class="w-full space-x-2 pb-1 px-2 flex"
            >
                @if ($post->image_path)
                    <div>
                        <a href="{{ Storage::url($post->image_path) }}">
                            <img
                                class="h-auto w-20 border border-primary-400 rounded-md hover:shadow-md"
                                src="{{ Storage::url($post->image_path) }}"
                                alt="{{ asset($post->image_name) }}"
                            ></img>
                        </a>
                    </div>
                @endif

                <div class="pb-1 text-sm">
                    <p class="text-sm">{{ Str::limit($post->body, 100) }}</p> 
                </div>
            </div>

            <div
                @if (Auth::user())
                    @if (Auth::user()->id == $post->user_id)
                        class="px-1 flex text-sm text-primary-50 justify-between w-full bg-primary-400 rounded-b-md"
                    @endif
                @endif
                class="px-1 flex text-sm text-primary-500 justify-between w-full bg-primary-300 rounded-b-md"
            >
                <p>{{ $post->reply->count() }} replies</p>
                <p class="order-last">
                    Posted By: {{ $post->User->name }} | Posted On: {{ $post->created_at }}
                </p>
            </div>
        </li>
    @endforeach
    </ul>

    {{ $posts->links() }}

@endsection
