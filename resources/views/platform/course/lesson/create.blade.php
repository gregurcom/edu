@extends('layouts.layout')

@section('title', 'Mentor - lesson create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('platform.lessons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{ $course->id }}" name="course_id">
                    <input type="text" name="title" class="form-control" placeholder="{{ __('app.input.title') }}">
                    @error('title')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <textarea name="information" class="form-control mt-2" placeholder="{{ __('app.input.information') }}" rows="5"></textarea>
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
        </div>
    </div>
@endsection

