@extends('layouts.layout')

@section('title', 'Mentor - subscriptions')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @if (session('status'))
            <div class="alert alert-dark mt-2 text-center">
                {{ session('info') }}
            </div>
        @endif

        @forelse ($courses as $course)
            <div class="mt-4">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark h3">{{ $course->title }}</a>
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
                {{ __('app.alert.no-subscribe-course') }}
            </div>
        @endforelse
    </div>
@endsection
