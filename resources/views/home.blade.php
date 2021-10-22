@extends('layouts.layout')

@section('content')
    <main class="px-3">
        <div class="row d-flex align-items-center">
            <div class="col-md-8">
                <div class="text-center info mt-5 mb-5">
                    <h1 class="mb-3">Mentor</h1>
                    <p class="h4">
                        {{ __('app.title.home-paragraph') }}
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('platform.categories.list') }}" class="course-button btn btn-outline-dark rounded-pill py-3 px-3 fw-bold">{{ __('app.button.courses') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('images/homeIlustrate.png') }}" width="350px" height="350px" id="homeIlustrate">
            </div>
        </div>
    </main>
@endsection
