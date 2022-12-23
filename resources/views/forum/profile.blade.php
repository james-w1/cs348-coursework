
@extends('layouts.app')

@section('title', '/profile/' . $user->name)

@section('header', '/profile/' . $user->name)

@section('content')
    <div class="p-2 space-x-2 flex w-full">
        <a 
            class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
            href="{{ route('forum.index') }}"
        >
            back
        </a>
        <livewire:logout />
    </div>
@endsection
