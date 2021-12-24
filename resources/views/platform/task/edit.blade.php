@extends('layouts.layout')

@section('title', 'Mentor - edit task')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="text-center">
                    <h1>Update Task</h1>
                </div>
                <form action="{{ route('platform.tasks.update', $task->id) }}" method="POST" class="mt-5">
                    @csrf
                    @method('PUT')

                    <input type="text" name="title" class="form-control" value="{{ $task->title }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mt-1">
                        <input type="datetime-local" name="end_time" class="form-control" value="{{ $task->end_time ? $task->end_time->format('Y-m-d\TH:i') : '' }}">
                        <button class="btn btn-outline-info" type="button">End Time (optional)</button>
                    </div>
                    @error('end_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <textarea name="description" class="form-control mt-1">{{ $task->description }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-outline-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
