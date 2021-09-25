@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-5">
            <div class="mt-3 text-center">
                <h3><a href="#" class="text-decoration-none text-dark">{{ $lesson->title }}</a></h3>
                <span class="text-secondary">{{ $lesson->created_at->day }} {{ $lesson->created_at->monthName }}, {{ $readDuration }}</span>
            </div>
            <div class="mt-5">
                <p>{{ $lesson->information }}</p>
            </div>
        </div>
    </div>
@endsection
