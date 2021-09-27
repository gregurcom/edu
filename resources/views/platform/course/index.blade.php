@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @can('view', $course)
            <div>
                <a href="{{ route('platform.lesson.creation', $course->id) }}" class="btn btn-outline-dark">Create lesson</a>
            </div>
        @endcan
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        <div class="text-center">
            <h2>
                {{ $course->title }}
                @auth
                    @if (Auth::user()->isFollowed($course->id))
                        <a href="{{ route('platform.course.unfollow', $course->id) }}" class="btn btn-outline-info">Unfollow</a>
                    @else
                        <a href="{{ route('platform.course.follow', $course->id) }}" class="btn btn-outline-info">Follow</a>
                    @endif
                @endauth
            </h2>
            (<span class="h5 mt-1">{{ $course->users()->count() ?: 0 }} students</span>)
        </div>
        @forelse ($course->lessons as $lesson)
            <div class="mt-5">
                <div class="mt-3">
                    <h4><a href="{{ route('platform.lesson.show', $lesson->id) }}" class="text-decoration-none text-dark">{{ $lesson->title }}</a></h4>
                    <div class="d-flex">
                        @can('view', $course)
                            <a href="{{ route('platform.lesson.edit-form', $lesson->id) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('platform.lesson.delete', $lesson->id) }}" method="POST" class="px-2">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                This course does not contain lessons yet
            </div>
        @endforelse
    </div>
@endsection