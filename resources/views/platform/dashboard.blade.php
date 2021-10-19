@extends('layouts.layout')

@section('title', 'Mentor - dashboard')

@section('content')
    <div class="container wrapper flex-grow-1 mt-3">
        <div>
            <a href="{{ route('platform.courses.create') }}" class="btn btn-outline-dark">Create course</a>
        </div>
        @if (session('status'))
            <div class="alert alert-info mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        @if ($courses->isNotEmpty())
            <div class="mt-5 mb-5">
                <h2 class="mb-5">Your courses:</h2>
                @foreach($courses as $course)
                    <div class="mt-3">
                        <h4><a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark">{{ $course->title }}</a></h4>
                        <p>{{ $course->description }}</p>
                        <div class="d-flex">
                            <a href="{{ route('platform.courses.edit', $course->id) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('platform.courses.destroy', $course->id) }}" method="POST" class="px-2">
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
            <div class="alert alert-info text-center">
                You don't have any courses yet
            </div>
        @endif
    </div>
@endsection
