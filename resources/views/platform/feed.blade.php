@extends('layouts.layout')

@section('title', 'Mentor - courses')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-3">
        @if (session('status'))
            <div class="alert alert-dark mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('platform.course.search') }}" method="GET" class="mb-5">
            <div class="row g-1 justify-content-end">
                <div class="col-auto">
                    <input type="search" name="q" class="form-control border-dark search-input" placeholder="{{ __('app.input.course-search') }}...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-dark">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        @error('q')
            <div class="alert alert-danger mt-1">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-4">
            <a href="{{ route('platform.categories.list') }}" class="btn btn-outline-dark">Categories</a>
        </div>
        @forelse ($courses as $course)
            <div class="row mb-4">
                <div class="col-md-8">
                    <a href="#" class="text-decoration-none text-muted">{{ $course->author->name }}</a> ·
                    <span class="text-muted">{{ $course->created_at->isoformat('Do MMM YY') }}</span>
                    <div class="d-block mt-1">
                        <a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark h4">{{ $course->title }}</a>
                    </div>
                    <div>
                        {{ $course->description }}
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <img src="{{ asset('images/social.png') }}" width="250" height="180">
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                {{ __('app.alert.category-without-courses') }}
            </div>
        @endforelse

        <div class="d-flex justify-content-center text-black">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
