@extends('layouts.layout')

@section('title', 'Mentor - registration')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('auth.registration.save') }}" method="POST">
                    @csrf

                    <input type="text" name="name" class="form-control" placeholder="{{ __('app.input.name') }}">
                    @error('name')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <input type="email" name="email" class="form-control mt-2" placeholder="{{ __('app.input.email') }}">
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

                    <div class="mt-2">
                        <a href="{{ route('auth.login') }}" class="text-dark">{{ __('auth.login') }}</a>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark" type="submit">{{ __('app.button.register') }}</button>
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
