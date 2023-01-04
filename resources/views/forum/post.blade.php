@extends('layouts.app')

@section('title', $sub_forum->name . '/' . $post->title)

@section('header')
    <span>
        / <a 
            class="hover:text-primary-400" 
            href="{{ route('forum.show', ['sub_forum'=>$sub_forum]) }}">{{ $sub_forum->name }}
           </a>
        / <a 
            class="hover:text-primary-400" 
            href="{{ route('post.show', ['sub_forum'=>$sub_forum, 'post'=>$post]) }}">{{ $post->title }}
          </a>
    </span>
@endsection

@section('content')
    <div class="p-2 space-y-2 bg-primary-200 rounded-md">
        <div class="flex w-full">
            <div>
                <p 
                    class="text-lg"
                >
                    {{ $post->title }} 
                </p>
            </div>
        </div>
        @if ( $post->image_path )
            <div class="justify-center flex">
                <a href="{{ Storage::url($post->image_path) }}" >
                    <img
                        class="img border border-primary-400 rounded-md h-40 w-auto hover:shadow-md"
                        src="{{ Storage::url($post->image_path) }}"
                        alt="{{ $post->image_name }}"
                    >
                </a>
            </div>
        @endif
        <p 
            class="text-base"
        >
            {{ $post->body }} 
        </p>
        <div 
            class="flex flex-row-reverse"
        >
            <p
                class="text-primary-500 text-sm"
            >
                Posted By: {{ $op->name }} | Posted On: {{ $post->created_at }}
            </p>
        </div>
    </div>

    <div 
        class="pt-2 space-x-2 flex w-full"
    >
        <a 
            class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100" 
            href="{{ route('forum.show', ['sub_forum' => $sub_forum]) }}">back
        </a>
        @if (Auth::user())
            <div class="">
                @livewire('quick-reply', ['sub_forum'=>$sub_forum, 'post' => $post])
            </div>
        @endif
    </div>

    <div class="pl-4 pt-2 space-y-2">
        @foreach($replies as $reply)
            <div 
                @if (Auth::user())
                    @if (Auth::user()->id == $reply->user_id)
                        class="p-2 bg-primary-300 rounded-md space-y-2"
                    @else
                        class="p-2 bg-primary-200 rounded-md space-y-2"
                    @endif
                @else
                    class="p-2 bg-primary-200 rounded-md space-y-2"
                @endif
            >
                <div 
                    class="flex justify-between text-lg w-full"
                >
                    <p class="text-base">
                        {{ $reply->body }}
                    </p>
                    @if (Auth::user())
                        @if (Auth::user()->id == $reply->user_id)
                            <div 
                                class="order-last flex space-x-2 text-sm text-secondary-700"
                            >
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
                    class="flex flex-row-reverse"
                >
                    <p 
                        class="text-sm text-primary-500"
                    >
                        Posted By: {{ $reply->User->name }} | Posted On: {{ $reply->created_at }}
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


@endsection
