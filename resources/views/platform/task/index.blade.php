@extends('layouts.layout')

@section('title', 'Mentor - tasks')

@section('content')
    <div class="container wrapper flex-grow-1 mt-5 mb-4">
        @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif

        @forelse ($tasks as $task)
            <div class="mb-5">
                <h3 class="d-inline"><a href="#" class="head-link text-decoration-none text-black">{{ $task->title }}</a></h3>
                <span class="text-secondary px-2">{{ __('app.title.limit-date') }}: {{ $task->end_time->format('Y-m-d H:i') ?? '-' }} </span>

                <p class="mt-2">{{ $task->description }}</p>
                <form action="{{ route('platform.tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-danger">{{ __('app.button.delete') }}</button>
                </form>
                <a href="{{ route('platform.tasks.edit', $task->id) }}" class="btn btn-outline-info">{{ __('app.button.edit') }}</a>
            </div>
        @empty
            <div class="alert alert-info text-center">
                You have no tasks yet
            </div>
        @endforelse

        <form action="{{ route('platform.tasks.store') }}" method="POST" class="mt-5">
            @csrf

            <input type="text" name="title" class="form-control" placeholder="{{ __('app.input.task') }}...">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="input-group mt-1">
                <input type="datetime-local" name="end_time" class="form-control">
                <button class="btn btn-outline-info" type="button">{{ __('app.button.end-time') }} ({{ __('app.input.optional') }})</button>
            </div>
            @error('end_time')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <textarea name="description" class="form-control mt-1" placeholder="{{ __('app.input.description') }}...({{ __('app.input.optional') }})"></textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-dark">{{ __('app.button.create') }}</button>
            </div>
        </form>
    </div>
@endsection
