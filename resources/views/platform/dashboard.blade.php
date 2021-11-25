@extends('layouts.layout')

@section('title', 'Mentor - dashboard')

@section('content')
    <div class="container wrapper flex-grow-1 mt-3">
        <div>
            <a href="{{ route('platform.courses.create') }}" class="btn btn-outline-dark">{{ __('app.button.create-course') }}</a>
            <a href="{{ route('platform.tasks') }}" class="btn btn-outline-dark">Tasks</a>
            @can('viewTelescope', 'App\Models\User')
                <a href="telescope" class="btn btn-outline-dark">Telescope</a>
            @endcan
        </div>
        @if (session('status'))
            <div class="alert alert-dark mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        @if ($courses->isNotEmpty())
            <div class="mt-5 mb-5">
                <h2 class="mb-5">{{ __('app.title.your-courses') }}:</h2>
                @foreach($courses as $course)
                    <div class="mt-3">
                        <h4><a href="{{ route('platform.courses.show', $course->id) }}" class="text-decoration-none text-dark">{{ $course->title }}</a></h4>
                        <p>{{ $course->description }}</p>
                        <div class="d-flex">
                            <a href="{{ route('platform.courses.edit', $course->id) }}" class="btn btn-outline-primary">{{ __('app.button.edit') }}</a>
                            <form action="{{ route('platform.courses.destroy', $course->id) }}" method="POST" class="px-2">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger">{{ __('app.button.delete') }}</button>
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
                {{ __('app.alert.no-dashboard-courses') }}
            </div>
        @endif
    </div>
@endsection
