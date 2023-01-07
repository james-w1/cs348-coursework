@extends('layouts.app')

@section('title', $sub_forum->name)

@section('header')
    <span>
        / <a class="hover:text-primary-400" href="{{ route('forum.show', ['sub_forum'=>$sub_forum]) }}">{{ $sub_forum->name }}</a>
    </span>
@endsection

@section('content')

    <div class="flex w-full px-2">
        <div class="flex-grow space-x-2">
            <a 
                class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100"
                href="{{ route('forum.index') }}"
            >
                Back
            </a>
                <a
                    class="rounded-md bg-primary-200 px-2 hover:bg-secondary-300 hover:text-primary-100" 
                    href="{{ route('post.create', ['sub_forum' => $sub_forum]) }}"
                >
                    Create Post
                </a>
        </div>
    </div>

        <div class="p-2 space-y-2">
            @if (!(blank($sticky_post)))
                <div
                    class="bg-primary-200 rounded-md"
                >
                            <div class="px-1 flex justify-between text-lg w-full">
                                <a
                                    class="text-secondary-500 hover:text-primary-400" 
                                    href="{{ route('post.show', ['sub_forum' => $sub_forum, 'post' => $sticky_post]) }}"
                                >
                                    {{ $sticky_post->title }}
                                </a>
                                <div class="order-last flex">
                                    <p>
                                        sticky post
                                    </p>
                                    @if (Auth::user())
                                        @if (Auth::user()->can('delete_posts'))
                                                <form 
                                                    class="space-x-1 text-sm text-secondary-700"
                                                    action="{{ route('post.delete', ['sub_forum'=>$sub_forum, 'post'=>$sticky_post]) }}" 
                                                    method="POST"
                                                >
                                                    <a 
                                                        class="hover:underline hover:text-secondary-500" 
                                                        href="{{ route('post.edit', ['post'=>$sticky_post, 'sub_forum'=>$sub_forum]) }}"
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
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div
                                class="w-full space-x-2 pb-1 px-2 flex"
                            >
                                @if ($sticky_post->image_path)
                                    <div>
                                        <a href="{{ Storage::url($post->image_path) }}">
                                            <img
                                                class="h-auto w-20 border border-primary-400 rounded-md text-sm overflow-hidden break-words hover:shadow-md"
                                                src="{{ Storage::url($post->image_path) }}"
                                                alt="{{ $post->image_name }}"
                                            ></img>
                                        </a>
                                    </div>
                                @endif

                                <div class="pb-1 text-sm">
                                    <p class="text-sm">{{ Str::limit($sticky_post->body, 100) }}</p> 
                                </div>
                            </div>

                            <div
                                class="px-1 flex text-sm text-primary-500 justify-between w-full bg-primary-300 rounded-b-md"
                            >
                                <p>{{ $sticky_post->reply->count() }} replies</p>
                                <p class="order-last">
                                    Posted By: <a class="hover:underline hover:text-primary-700" href="{{ route('profile.show', ['user'=>$sticky_post->User]) }}">{{ $sticky_post->User->name }}</a> | Posted On: {{ $sticky_post->created_at }}
                                </p>
                            </div>
                </div>
            @endif

        <ul role="list" class="space-y-2 bg-primary-100">
        @foreach($posts as $post)
            @if (blank($sticky_post) or $post->id != $sticky_post->id)
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
                                @if (Auth::user()->id == $post->user_id or Auth::user()->can('delete_posts'))
                                    <div class="order-last flex">
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

                    <div
                        class="w-full space-x-2 pb-1 px-2 flex"
                    >
                        @if ($post->image_path)
                            <div>
                                <a href="{{ Storage::url($post->image_path) }}">
                                    <img
                                        class="h-auto w-20 border border-primary-400 rounded-md text-sm overflow-hidden break-words hover:shadow-md"
                                        src="{{ Storage::url($post->image_path) }}"
                                        alt="{{ $post->image_name }}"
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
                            Posted By: <a class="hover:underline hover:text-primary-700" href="{{ route('profile.show', ['user'=>$post->User]) }}">{{ $post->User->name }}</a> | Posted On: {{ $post->created_at }}
                        </p>
                    </div>
                </li>
            @endif
        @endforeach
        </ul>
    </div>

    {{ $posts->links() }}

@endsection
