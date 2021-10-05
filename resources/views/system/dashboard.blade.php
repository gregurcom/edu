@extends('layouts.layout')

@section('title', 'Mentor - dashboard')

@section('content')
    <div class="container wrapper flex-grow-1 mt-3">
        <a href="{{ route('system.categories.create') }}" class="btn btn-outline-dark mb-3">Create category</a>
        @if (session('status'))
            <div class="alert alert-info mt-2 text-center">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-bordered mt-3" id="control-table">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Courses</th>
                    <th scope="col">Created</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $position => $category)
                    <tr class="text-center">
                        <td>{{ $position + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->courses->count() }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a href="{{ route('system.categories.edit', $category->id) }}" class="btn btn-outline-primary w-75">Edit</a>
                            <form action="{{ route('system.categories.destroy', $category->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger w-75">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
