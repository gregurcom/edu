@extends('layouts.layout')

@section('title', $lesson->title . ' - edit')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('platform.lessons.update', $lesson->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" name="title" class="form-control" value="{{ $lesson->title }}">
                    @error('title')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <textarea name="information" class="form-control mt-2" rows="5">{{ $lesson->information }}</textarea>
                    @error('information')
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

