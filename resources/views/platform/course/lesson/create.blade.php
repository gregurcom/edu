@extends('layouts.layout')

@section('title', 'Mentor - lesson create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('platform.lessons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{ $course->id }}" name="course_id">
                    <input type="text" name="title" class="form-control" placeholder="Title">
                    @error('title')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <textarea name="information" class="form-control mt-2" placeholder="Information" rows="5"></textarea>
                    @error('information')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <select class="form-control mt-2" name="status">
                        <option value="1">Important (send emails to subscribers)</option>
                        <option value="0">Not important</option>
                    </select>

                    <input type="file" name="files[]" class="mt-2" multiple>
                    @error('files')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark w-25" type="submit">Create</button>
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

