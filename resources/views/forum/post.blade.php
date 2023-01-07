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
    <div class="space-y-2 bg-primary-200 rounded-md">
        <div class="bg-primary-300 rounded-t-md flex p-1 w-full">
            <div class="flex-grow">
                <p 
                    class="text-lg"
                >
                    {{ $post->title }} 
                </p>
            </div>
            @if (Auth::user())
                @if (Auth::user()->id == $post->user_id or Auth::user()->can('delete_posts'))
                    <div class="order-last">
                        <form 
                            class="space-x-1 text-sm text-secondary-700"
                            action="{{ route('post.delete', ['sub_forum'=>$sub_forum, 'post'=>$post]) }}" 
                            method="POST"
                        >
                            <a 
                                class="hover:underline hover:text-secondary-500" 
                                href="{{ route('post.edit', ['post'=>$post, 'sub_forum'=>$sub_forum]) }}"
                            >
                                edit
                            </a>

                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="hover:underline hover:text-secondary-500" 
                            >
                                delete
                            </button>
                        </form>
                    </div>
                @endif
            @endif
        </div>
        @if ( $post->image_path )
            <div class="justify-center flex">
                <a href="{{ Storage::url($post->image_path) }}" >
                    <img
                        class="text-sm overflow-hidden img border border-primary-400 text-center rounded-md w-64 h-auto max-h-96 hover:shadow-md"
                        src="{{ Storage::url($post->image_path) }}"
                        alt="Image '{{ $post->image_name }}' missing"
                    >
                </a>
            </div>
        @endif
        <div class="p-2 space-y-2">
            @foreach (explode(PHP_EOL, $post->body) as $paragrah)
                <p>
                    {{ $paragrah }} 
                </p>
            @endforeach
        </div>
        <div 
            class="flex p-1 flex-row-reverse bg-primary-300 rounded-b-md"
        >
            <p
                class="text-primary-500 text-sm"
            >
                Posted By: <a class="hover:underline hover:text-primary-700" href="{{ route('profile.show', ['user'=>$op]) }}">{{ $op->name }}</a> | Posted On: {{ $post->created_at }}
            </p>
        </div>
    </div>


    <div class="">
        @livewire('replies', ['sub_forum'=>$sub_forum, 'post'=>$post])
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="text-other-red">{{ $error }}</p>
        @endforeach
    @endif


@endsection
