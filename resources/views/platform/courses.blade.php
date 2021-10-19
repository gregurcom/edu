@extends('layouts.layout')

@section('title', 'Mentor - courses')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-info mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('platform.course.search') }}" method="GET">
            <div class="row g-1 justify-content-end">
                <div class="col-auto">
                    <input type="search" name="q" class="form-control border-dark search-input" placeholder="Search course...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-dark">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        @forelse ($categories as $category)
            <h2 class="mt-5">{{ $category->name }}</h2>
            @forelse ($category->courses()->with('rates', 'author')->get() as $course)
                <div class="mt-4">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-8">
                                <ul>
                                    <li>
                                        <a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark h3">{{ $course->title }}</a>
                                        <span class="h4 px-2">(<a href="#" class="text-decoration-none text-dark">{{ $course->author->name }}</a>)</span>
                                    </li>
                                </ul>
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
                    This category does not contain courses yet
                </div>
            @endforelse

        @empty
            <div class="alert alert-info">
                There are no registered courses yet
            </div>
        @endforelse
    </div>
@endsection
