@extends('layouts.layout')

@section('title', 'Mentor - verify email')

@section('content')
    <div class="content">
        <div class="text-center">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h1>Verify email</h1>

            <p>Please verify your email address by clicking the link in the mail we just sent you. Thanks!</p>
            <form action="{{ route('verification.request') }}" method="GET">
                @csrf

                <button type="submit" class="btn btn-outline-info">Request a new link</button>
            </form>
        </div>
    </div>
@endsection
