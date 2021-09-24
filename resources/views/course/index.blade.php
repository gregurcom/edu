@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @can('view', $course)
            <div>
                <a href="{{ route('lesson.creation', $course->id) }}" class="btn btn-outline-dark">Create lesson</a>
            </div>
        @endcan
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        @foreach ($course->lessons as $lesson)
            <div class="mt-5">
                <div class="mt-3">
                    <h3><a href="{{ route('lesson.show', $lesson->id) }}" class="text-decoration-none text-dark">{{ $lesson->title }}</a></h3>
                    <div class="d-flex">
                        @can('view', $course)
                            <a href="{{ route('lesson.edit-form', $lesson->id) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('lesson.delete', $lesson->id) }}" method="POST" class="px-2">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection