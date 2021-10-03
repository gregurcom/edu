@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="{{ route('system.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" name="name" class="form-control" placeholder="Category">
                    @error('name')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-dark w-25" type="submit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

