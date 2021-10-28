@extends('layouts.layout')

@section('title', 'Mentor - reset password')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                @if (session('status'))
                    <div class="alert alert-dark">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <input type="email" name="email" class="form-control" placeholder="{{ __('app.input.email') }}">
                    @error('email')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <input type="password" name="password" class="form-control mt-2" placeholder="{{ __('app.input.password') }}">
                    <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="{{ __('app.input.password-repeat') }}">
                    @error('password')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark" type="submit">{{ __('app.button.reset') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
