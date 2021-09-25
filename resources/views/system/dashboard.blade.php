@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-3">
        @if (session('status'))
            <div class="alert alert-success mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif

        <a href="{{ route('system.category.creation') }}" class="btn btn-outline-primary">Create category</a>
    </div>
@endsection
