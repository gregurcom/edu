@extends('layouts.layout')

@section('title', $lesson->title . ' - edit')

@section('content')
    <div class="container container wrapper flex-grow-1 mt-5 mb-5">
        <form action="{{ route('platform.lessons.update', $lesson->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="title" class="form-control mb-3" value="{{ $lesson->title }}">
            @error('title')
                <div class="alert alert-danger mt-1">
                    {{ $message }}
                </div>
            @enderror

            <input id="post_body" class="mt-5" value="{!! $lesson->information !!}" type="hidden" name="information">
            <trix-editor input="post_body" class="trix-content"></trix-editor>
            @error('information')
                <div class="alert alert-danger mt-1">
                    {{ $message }}
                </div>
            @enderror

            <div class="text-center mt-3">
                <button class="btn btn-outline-dark" type="submit">{{ __('app.button.update') }}</button>
            </div>
        </form>

        @if (session('status'))
            <div class="alert alert-danger mt-2">
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection

