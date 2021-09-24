@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        @foreach ($categories as $category)
            <h2>{{ $category->name }}</h2>
            @foreach ($category->courses as $course)
                <div class="mt-5 mr-3">
                    <div class="mt-3">
                        <div class="d-inline-block">
                            <ul>
                                <li><h3><a href="{{ route('course.show', $course->id) }}" class="text-decoration-none text-dark">{{ $course->title }}</a></h3></li>
                            </ul>
                        </div>
                        <div class="pull-right d-flex align-items-center">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span class="h5 mt-1 px-4">12 students</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
