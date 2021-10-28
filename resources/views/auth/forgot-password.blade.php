@extends('layouts.layout')

@section('title', 'Mentor - forgot password')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <input type="email" name="email" class="form-control" placeholder="{{ __('app.input.email') }}">
                    @error('email')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark" type="submit">{{ __('app.button.submit') }}</button>
                    </div>
                </form>

                @if (session('status'))
                    <div class="alert alert-dark mt-2">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
