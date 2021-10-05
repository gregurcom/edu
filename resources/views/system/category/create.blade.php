@extends('layouts.layout')

@section('title', 'Mentor - category create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div>
                    Existing categories:
                    <ul>
                        @foreach ($categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <form action="{{ route('system.categories.store') }}" method="POST">
                    @csrf

                    <input type="text" name="name" class="form-control" placeholder="Category">
                    @error('name')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark w-25" type="submit">Create</button>
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

