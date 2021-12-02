@extends('layouts.layout')

@section('title', $course->title . ' - course')

@section('description', $course->description)

@section('content')
    <div class="container wrapper flex-grow-1 mt-3 mb-5" itemscope itemtype="http://schema.org/Course">
        @can('view', $course)
            <a href="{{ route('platform.lessons.create', $course->id) }}" class="btn btn-outline-dark">{{ __('app.button.create-lesson')  }}</a>
        @endcan

        <div class="text-center">
            <img src="{{ asset('images/404.png') }}" width="550" height="300">
            <div class="mt-3 text-center">
                <div class="row">
                    <div class="col-md-6" id="courseTitle">
                        <h2 itemprop="name">{{ $course->title }}</h2>
                    </div>
                    <div class="col-md-6" id="subscribeButton">
                        @auth
                            <div class="px-3">
                                @if (Auth::user()->isSubscribedOnCourse($course->id))
                                    <form action="/" method="GET">
                                        <button type="submit" class="btn btn-outline-dark">{{ __('app.button.unsubscribe') }}</button>
                                    </form>
                                @else
                                    <form action="/" method="GET">
                                        <button type="submit" class="btn btn-outline-dark">{{ __('app.button.subscribe') }}</button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <a href="{{ route('auth.login') }}" class="btn btn-outline-dark">{{ __('app.button.subscribe') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
            <form action="{{ route('platform.course.rate', $course->id) }}" method="GET" class="mt-3">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="{{ $i }}">
                        <input name="rate" type="submit" value="{{ $i }}" id="{{ 'rate' . $i }}" class="rate btn btn-outline-dark {{ $course->isRateByUser(Auth::id()) == $i ? 'bg-dark text-light' : ' ' }}">
                    </label>
                @endfor
            </form>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                @forelse ($course->lessons as $lesson)
                    <div class="mt-4">
                        <h4 class="lesson-title">
                            <a href="{{ route('platform.lessons.show', $lesson->id) }}" class="text-decoration-none text-dark head-link">{{ $lesson->title }}</a>
                        </h4>
                        @can('view', $course)
                            <div class="d-flex lesson-title mt-3">
                                <a href="{{ route('platform.lessons.edit', $lesson->id) }}" class="btn btn-outline-primary">{{ __('app.button.edit') }}</a>
                                <form action="{{ route('platform.lessons.destroy', $lesson->id) }}" method="POST" class="px-2">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger">{{ __('app.button.delete') }}</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                @empty
                    <div class="alert alert-info text-center">
                        {{ __('app.alert.no-lessons') }}
                    </div>
                @endforelse
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <div>
                    <h2>{{ __('app.title.about-course') }}:</h2>
                    <p>{{ $course->description }}</p>
                    <h4>{{ __('app.title.author') }}: {{ $course->author->name }}</h4>
                    <h4>{{ __('app.title.subscriptions') }}: {{ $course->users()->count() }}</h4>
                    <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <h4>{{ __('app.title.average-rating') }}: <span itemprop="ratingValue">{{ round($course->averageRate()) }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
