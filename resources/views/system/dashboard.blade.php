@extends('layouts.layout')

@section('content')
    <div class="container wrapper flex-grow-1 mt-3">
        <a href="{{ route('system.categories.create') }}" class="btn btn-outline-dark mb-3">Create category</a>
        @if (session('status'))
            <div class="alert alert-info text-center">
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
                        <td>
                            <a href="{{ route('platform.courses.list', $category->id) }}" class="text-dark">{{ $category->name }}</a>
                        </td>
                        <td>{{ $category->courses->count() }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a href="{{ route('system.categories.edit', $category->id) }}" class="btn btn-outline-primary table-button">Edit</a>
                            <form action="{{ route('system.categories.destroy', $category->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger table-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
