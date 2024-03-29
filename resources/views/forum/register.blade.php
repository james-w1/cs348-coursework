@extends('layouts.app')

@section('title', 'register')

@section('header', '/ register')

@section('content')

<div class="p-2 space-x-2 w-full flex">
    <a 
        class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100" 
        href="{{ route('forum.index') }}"
    >
        back
    </a>
</div>

<div class="flex items-center justify-center">
    <div class="bg-primary-200 flex rounded-md p-2">
        <form class="px-2 space-y-2" method="POST" rows="4" action=" {{ route('register.store') }}">
            @csrf
            <p class="text-primary-600">User Name</p>
            <input class="p-1 rounded-md bg-primary-100" type="text" name="user_name">

            <p class="text-primary-600">Email</p>
            <input class="p-1 rounded-md bg-primary-100" type="text" name="email">

            <p class="text-primary-600">Password</p>
            <input class="p-1 rounded-md bg-primary-100" type="password" name="password" >

            <div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-other-red">{{ $error }}</p>
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
