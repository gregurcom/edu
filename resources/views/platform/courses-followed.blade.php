@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        @forelse ($courses as $course)
            <div class="mt-4">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('platform.course.show', $course->id) }}" class="text-decoration-none text-dark h3">{{ $course->title }}</a>
                            <span class="h4 px-2">({{ $course->author->name }})</span>
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
            <div class="alert alert-info text-center">
                You have not followed to any course yet
            </div>
        @endforelse
    </div>
@endsection
