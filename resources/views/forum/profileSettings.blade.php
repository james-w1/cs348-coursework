@extends('layouts.app')

@section('title', '/ profile / ' . $user->name . ' / settings')

@section('header', '/ profile / ' . $user->name . ' / settings')
    
@section('content')
    <div class="pb-2 flex w-full">
        <a 
            class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
            href="{{ route('profile.show', ['user'=>$user]) }}"
        >
            back
        </a>
    </div>

    <div class="space-y-6">
        <div 
            class="px-20 p-1 flex flex-col items-center justify-center bg-primary-200 rounded-md overflow-y-scroll"
        >
            <p class="underline"> Change Username </p>
            <div 
                class="px-10 py-2 flex items-center justify-center rounded-md"
            >
                <form class="space-y-2">
                    @csrf
                    <p>New Name: 
                        <input 
                            class="px-2 bg-primary-50 rounded-md" 
                            name="name" 
                            type="text"
                        >
                    </p>
                    <p>Password: 
                        <input 
                            class="px-2 bg-primary-50 rounded-md" 
                            name="password" 
                            type="password"
                        >
                    </p>
                    <div class="flex w-full items-center justify-center">
                        <input 
                            class="p-1 rounded-md bg-primary-50 hover:bg-secondary-300 hover:text-primary-100" 
                            type="submit" 
                            value="Submit"
                        >
                    </div>
                </form>
            </div>
        </div>

        <div 
            class="px-20 p-1 flex flex-col items-center justify-center bg-primary-200 rounded-md overflow-y-scroll"
        >
            <p class="underline"> Change Password </p>
            <div 
                class="px-10 py-2 flex items-center justify-center rounded-md"
            >
                <form class="space-y-2">
                    @csrf
                    <p>Current Password: 
                        <input 
                            class="px-2 bg-primary-50 rounded-md"
                            name="name"
                            type="text"
                        >
                    </p>
                    <p>New Password: 
                        <input
                            class="px-2 bg-primary-50 rounded-md" 
                            name="password" 
                            type="password"
                        >
                    </p>
                    <div class="flex w-full items-center justify-center">
                        <input 
                            class="p-1 rounded-md bg-primary-50 hover:bg-secondary-300 hover:text-primary-100" 
                            type="submit" 
                            value="Submit"
                        >
                    </div>
                </form>
            </div>
        </div>

        <div 
            class="px-20 p-1 flex flex-col items-center justify-center bg-primary-200 rounded-md overflow-y-scroll"
        >
            <p class="underline"> Delete Account </p>
            <div 
                class="px-10 py-2 flex items-center justify-center rounded-md"
            >
                <form class="space-y-2" method="POST" action="{{ route('profile.delete', ['user'=>$user]) }}">
                    @csrf
                    <p>Current Password: 
                        <input 
                            class="px-2 bg-primary-50 rounded-md"
                            name="password"
                            type="password"
                        >
                    </p>
                    <div>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p style="color: red;">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                    <div class="flex w-full items-center justify-center">
                        <input 
                            class="p-1 rounded-md text-primary-50 bg-other-red hover:bg-primary-500 hover:text-primary-900" 
                            type="submit" 
                            value="Delete Account"
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
