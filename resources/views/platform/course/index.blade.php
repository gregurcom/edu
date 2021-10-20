@extends('layouts.layout')

@section('title', $course->title . ' - course')

@section('description', $course->description)

@section('content')
    <div class="container wrapper flex-grow-1 mt-3 mb-5">
        @can('view', $course)
            <a href="{{ route('platform.lessons.create', ['course' => $course->id]) }}" class="btn btn-outline-dark">Create lesson</a>
        @endcan

        @if (session('status'))
            <div class="alert alert-info text-center">
                {{ session('status') }}
            </div>
        @endif
        <div class="text-center">
            <div class="d-flex justify-content-center mt-2">
                <h2>{{ $course->title }}</h2>
                @auth
                    <div class="px-3">
                        @if (Auth::user()->isSubscribed($course->id))
                            <form action="{{ route('platform.subscriptions.destroy', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" value="{{ $course->id }}" name="course_id">
                                <button type="submit" class="btn btn-outline-dark">Unsubscribe</button>
                            </form>
                        @else
                            <form action="{{ route('platform.subscriptions.store', $course->id) }}" method="POST">
                                @csrf

                                <input type="hidden" value="{{ $course->id }}" name="course_id">
                                <button type="submit" class="btn btn-outline-dark">Subscribe</button>
                            </form>
                        @endif
                    </div>
                @endauth
            </div>
            <form action="{{ route('platform.course.rate', $course->id) }}" method="GET" class="mt-3">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="{{ $i }}">
                        <input name="rate" type="submit" value="{{ $i }}" id="{{ 'rate' . $i }}" class="rate btn btn-outline-dark {{ $course->isRateByUser() == $i ? 'bg-dark text-light' : ' ' }}">
                    </label>
                @endfor
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-5 mb-4">Lessons: ({{ $course->lessons->count() }})</h2>
                @forelse ($course->lessons as $lesson)
                    <div class="mt-4">
                        <h4><a href="{{ route('platform.lessons.show', $lesson->id) }}" class="text-decoration-none text-dark">{{ $lesson->title }}</a></h4>
                        <div class="d-flex">
                            @can('view', $course)
                                <a href="{{ route('platform.lessons.edit', $lesson->id) }}" class="btn btn-outline-primary">Edit</a>
                                <form action="{{ route('platform.lessons.destroy', $lesson->id) }}" method="POST" class="px-2">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center">
                        This course does not contain lessons yet
                    </div>
                @endforelse
            </div>
            <div class="col-md-6 mt-5 d-flex justify-content-center">
                <div>
                    <h2>About this course:</h2>
                    <p>{{ $course->description }}</p>
                    <h4>Author: {{ $course->author->name }}</h4>
                    <h4>Lesson subscribers: ({{ $course->users()->count() ?: 0 }} students)</h4>
                    <h4>Average rating: {{ round($course->averageRate()) }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
