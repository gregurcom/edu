@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('platform.course.search') }}" method="GET">
            <div class="row g-1 justify-content-end">
                <div class="col-auto">
                    <input type="search" name="q" class="form-control" placeholder="Search course...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-dark">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        @forelse ($courses as $course)
            <div class="mt-4">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>
                                    <a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark h3">{{ $course->title }}</a>
                                    <span class="h4 px-2">({{ $course->author->name }})</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 d-flex">
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
            <div class="alert alert-danger mt-2 text-center">
                No results were found for your search
            </div>
        @endforelse
    </div>
@endsection
