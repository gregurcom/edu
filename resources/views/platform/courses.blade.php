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

        <div class="text-center mb-5 mt-5">
            <h2>
                <a href="{{ route('platform.courses.list', $category->id) }}" class="text-dark text-decoration-none title-border">{{ $category->name }}</a>
            </h2>
        </div>
        @forelse ($courses as $course)
            <div class="mt-5">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark h3">{{ $course->title }}</a>
                            <span class="h4 px-2">(<a href="#" class="text-decoration-none text-dark">{{ $course->author->name }}</a>)</span>
                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="px-3">
                                @if ($course->rates->count('id') > 0)
                                    <span>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="star fa fa-star{{ round($course->averageRate()) >= $i ? '' : '-o' }}"></i>
                                        @endfor
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
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
