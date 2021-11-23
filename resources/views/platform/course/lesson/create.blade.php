@extends('layouts.layout')

@section('title', 'Mentor - lesson create')

@section('content')
    <div class="container container wrapper flex-grow-1 mt-5 mb-5">
        <form action="{{ route('platform.lessons.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" value="{{ $course->id }}" name="course_id">
            <input type="text" name="title" class="form-control mb-3" placeholder="{{ __('app.input.title') }}">
            @error('title')
                <div class="alert alert-danger mt-1">
                    {{ $message }}
                </div>
            @enderror

            <input id="post_body" class="mt-5" value="" type="hidden" name="information">
            <textarea name="information" class="form-control"></textarea>
            @error('information')
                <div class="alert alert-danger mt-1">
                    {{ $message }}
                </div>
            @enderror

            <select class="form-control mt-2" name="status">
                <option value="1">{{ __('app.input.important-lesson') }}</option>
                <option value="0">{{ __('app.input.not-important-lesson') }}</option>
            </select>

            <input type="file" name="files[]" class="mt-2" multiple>
            @error('files')
                <div class="alert alert-danger mt-1">
                    {{ $message }}
                </div>
            @enderror
            <div class="text-center mt-3">
                <button class="btn btn-outline-dark" type="submit">{{ __('app.button.create') }}</button>
            </div>
        </form>

        @if (session('status'))
            <div class="alert alert-danger mt-2">
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection

