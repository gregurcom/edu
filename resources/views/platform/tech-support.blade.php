@extends('layouts.layout')

@section('title', 'Mentor - tech support')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="text-center">
                    <h3><span class="head-link">Mentor - {{ __('app.title.tech-support') }}</span></h3>
                </div>
                <form action="{{ route('platform.tech-support.send') }}" method="POST" class="mt-3">
                    @csrf

                    <textarea name="text" class="form-control mt-2" placeholder="{{ __('app.input.description') }}" rows="5"></textarea>
                    @error('text')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark" type="submit">{{ __('app.button.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

