@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-3">
        <div>
            <a href="{{ route('course.creation') }}" class="btn btn-outline-dark">Create course</a>
        </div>
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        @if ($courses->isNotEmpty())
            <div class="mt-5">
                @foreach($courses as $course)
                    <div class="mt-3">
                        <h3><a href="{{ route('course.show', $course->id) }}" class="text-decoration-none text-dark">{{ $course->title }}</a></h3>
                        <p>{{ $course->description }}</p>
                        <div class="d-flex">
                            <a href="{{ route('course.edit-form', $course->id) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('course.delete', $course->id) }}" method="POST" class="px-2">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    @if (!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div>
        @else
            <div class="alert alert-info mt-3 text-center">
                You don't have any courses yet
            </div>
        @endif
    </div>
@endsection
