@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-5">
        @can('view', $course)
            <div>
                <a href="{{ route('platform.lessons.create', ['course_id' => $course->id]) }}" class="btn btn-outline-dark">Create lesson</a>
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
                <span class="mt-1">({{ $course->users()->count() ?: 0 }} students)</span>
                @auth
                    @if (Auth::user()->isFollowed($course->id))
                        <form action="{{ route('platform.subscriptions.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="hidden" value="{{ $course->id }}" name="course_id">
                            <button type="submit" class="btn btn-outline-info">Unsubscribe</button>
                        </form>
                    @else
                        <form action="{{ route('platform.subscriptions.store', $course->id) }}" method="POST">
                            @csrf

                            <input type="hidden" value="{{ $course->id }}" name="course_id">
                            <button type="submit" class="btn btn-outline-info">Subscribe</button>
                        </form>
                    @endif
                @endauth
            </h2>
            <form action="{{ route('platform.course.rate', $course->id) }}" method="GET">
                @if ($course->isRate())
                    @for ($i = 1; $i <= 5; $i++)
                        <label for="{{ $i }}">
                            <input name="rate" type="submit" value="{{ $i }}" id="{{ 'rate' . $i }}" class="rate btn btn-outline-dark {{ $course->rates()->where('user_id', Auth::id())->first()->rate == $i ? 'bg-dark text-light' : ' ' }}">
                        </label>
                    @endfor
                @else
                    @for ($i = 1; $i <= 5; $i++)
                        <label for="{{ $i }}">
                            <input name="rate" type="submit" value="{{ $i }}" id="{{ 'rate' . $i }}" class="rate btn btn-outline-dark">
                        </label>
                    @endfor
                @endif
            </form>
        </div>
        @forelse ($course->lessons as $lesson)
            <div class="mt-5">
                <div class="mt-3">
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
            </div>
        @empty
            <div class="alert alert-info text-center mt-2">
                This course does not contain lessons yet
            </div>
        @endforelse
    </div>
@endsection
