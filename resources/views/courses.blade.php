@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif
        <div class="input-group justify-content-end">
            <div class="form-outline">
                <input type="search" id="form1" class="form-control" placeholder="Search course...">
            </div>
            <button type="button" class="btn btn-outline-dark">
                <i class="fa fa-search"></i>
            </button>
        </div>
        @foreach ($categories as $category)
            <h2 class="mt-5">{{ $category->name }}</h2>
            @foreach ($category->courses as $course)
                <div class="mt-4">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>
                                        <a href="{{ route('course.show', $course->id) }}" class="text-decoration-none text-dark h3">{{ $course->title }}</a>
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
            @endforeach
        @endforeach
    </div>
@endsection
