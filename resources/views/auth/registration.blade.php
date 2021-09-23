@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('auth.registration.save') }}" method="POST">
                    @csrf

                    <input type="text" name="name" class="form-control" placeholder="Name">
                    @error('name')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <input type="email" name="email" class="form-control mt-2" placeholder="Email">
                    @error('email')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <input type="password" name="password" class="form-control mt-2" placeholder="Password">
                    <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Password repeat">
                    @error('password')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <a href="{{ route('auth.login') }}">Login</a>

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark w-25" type="submit">Submit</button>
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
