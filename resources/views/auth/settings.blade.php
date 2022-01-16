@extends('layouts.layout')

@section('title', 'Mentor - settings')

@section('content')
    <div class="container">
        <div class="row mt-3 mb-3">
            @if (session('status'))
                <div class="alert alert-dark mt-2 text-center">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/' . Auth::user()->avatar) }}" width="150" height="200" class="mb-3" alt="{{ Auth::user()->name }}">
                @error('image')
                    <div class="alert alert-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
                <form action="{{ route('auth.settings.modify-avatar') }}" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center">
                    @csrf

                    <input type="file" class="w-25 form-control" name="image">
                    <button type="submit" class="btn btn-outline-dark btn-modify">Modify</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="settings-data">
                    <form action="{{ route('auth.settings.modify-name') }}" method="POST">
                        @csrf

                        <div class="d-flex justify-content-start form-modify-name">
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control w-25 d-inline">
                            <button type="submit" class="btn btn-outline-dark btn-modify">Modify</button>
                        </div>
                        @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </form>
                    <form action="{{ route('auth.settings.modify-password') }}" method="POST" class="mt-2">
                        @csrf

                        <input type="password" name="old_password" class="form-control mt-1 w-50 d-inline" placeholder="Old password...">
                        @error('old_password')
                            <div class="alert alert-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="password" name="password" class="form-control mt-1 w-50 d-inline" placeholder="New password...">
                        @error('password')
                            <div class="alert alert-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="password" name="password_confirmation" class="form-control mt-1 w-50 d-inline" placeholder="Confirm new password...">
                        <br>
                        <button type="submit" class="btn btn-outline-dark mt-2">Modify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
