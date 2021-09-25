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
        @foreach ($categories as $category)
            <h2 class="mt-5">{{ $category->name }}</h2>
            @forelse ($category->courses as $course)
                <div class="mt-4">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>
                                        <a href="{{ route('platform.course.show', $course->id) }}" class="text-decoration-none text-dark h3">{{ $course->title }}</a>
                                        <span class="h4 px-2">({{ $course->author->name }})</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="px-3">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="h5 mt-1">12 students</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    This course does not contain lessons yet
                </div>
            @endforelse
        @endforeach
    </div>
@endsection
