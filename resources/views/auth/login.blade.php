@extends('layouts.layout')

@section('title', 'Mentor - login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('auth.authenticate') }}" method="POST">
                    @csrf

                    <input type="email" name="email" class="form-control" placeholder="Email">
                    @error('email')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <input type="password" name="password" class="form-control mt-2" placeholder="Password">
                    @error('password')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mt-2">
                        <a href="{{ route('auth.registration') }}" class="text-dark">Registration</a>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark w-25" type="submit">Login</button>
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
