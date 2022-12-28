@extends('layouts.app')

@section('title', '/profile/' . $user->name . '/settings')

@section('header', '/profile/' . $user->name . '/settings')
    
@section('content')
    <div class="p-2 space-x-2 flex w-full">
        <a 
            class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
            href="{{ route('profile.show', ['user'=>$user]) }}"
        >
            back
        </a>
    </div>

    <div 
        class="px-20 p-1 flex flex-col items-center justify-center bg-primary-200 rounded-md overflow-y-scroll"
    >
        <p> change username </p>
        <div class="px-10 py-2 flex items-center justify-center rounded-md">
            <form class="space-y-2">
                <p>new name: 
                    <input class="px-2 bg-primary-50 rounded-md" name="name" type="text">
                </p>
                <p>password: 
                    <input class="px-2 bg-primary-50 rounded-md" name="password" type="password">
                </p>
                <input 
                    class="p-1 rounded-md bg-primary-50 hover:bg-secondary-300 hover:text-primary-100" 
                    type="submit" 
                    value="submit"
                >
            </form>
        </div>
    </div>

@endsection
