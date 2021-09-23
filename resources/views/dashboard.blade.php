@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-3">
        <div>
            <a href="{{ route('course.creation') }}" class="btn btn-outline-dark">Create course</a>
        </div>
        @if ($courses->isNotEmpty())
            <div class="mt-5">
                @foreach($courses as $course)
                    <div class="mt-3">
                        <h3><a href="#" class="text-decoration-none text-dark">{{ $course->title }}</a></h3>
                        <p>{{ $course->description }}</p>
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

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection
