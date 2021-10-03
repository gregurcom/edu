@extends('layouts.layout')

@section('content')
    <main class="px-3">
        <div class="text-center info">
            <h1 class="mb-3">Mentor</h1>
            <p class="h4">Mentor is a platform where anyone can share their knowledge</p>
            <p class="h4">Become a student or a mentor chose your favorite category</p>
            <div class="d-flex justify-content-center mt-5">
                <span class="material-icons">
                    language
                </span>
                <div class="px-5">
                    <a href="{{ route('platform.courses.index') }}" class="course-button btn btn-outline-dark rounded-pill py-3 px-3 fw-bold">Courses</a>
                </div>
                <span class="material-icons">
                    sentiment_satisfied
                </span>
            </div>
        </div>
    </main>
@endsection
