@extends('layouts.layout')

@section('title', 'Mentor - courses')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-3">
        @if (session('status'))
            <div class="alert alert-dark mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('platform.course.search') }}" method="GET">
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

        <div class="mb-5 mt-3 text-center">
            <a href="{{ route('platform.courses.list', $category->id) }}" class="text-dark text-decoration-none head-link h1">{{ $category->name }}</a>
        </div>
        @forelse ($courses as $course)
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="d-block mb-2">
                        <a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark h4">{{ $course->title }}</a>
                    </div>
                    <div class="mb-1">
                        {{ $course->description }}
                    </div>
                    <a href="#" class="text-decoration-none text-muted">{{ $course->author->name }}</a> ·
                    <span class="text-muted">{{ $course->created_at->isoformat('Do MMM YY') }}</span>
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
