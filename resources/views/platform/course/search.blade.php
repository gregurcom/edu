@extends('layouts.layout')

@section('title', 'Mentor - search')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-dark text-center">
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

        @forelse ($courses as $course)
            <div class="row mb-2 mt-4">
                <div class="col-md-8">
                    <div class="d-block mb-2">
                        <a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark h4">{{ $course->title }}</a>
                        <div class="px-3 d-inline">
                            @if ($course->rates->count('id') > 0)
                                <span>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="star fa fa-star{{ round($course->averageRate()) >= $i ? '' : '-o' }}"></i>
                                    @endfor
                                </span>
                            @endif
                        </div>
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
    </div>
@endsection
