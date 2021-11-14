@extends('layouts.layout')

@section('title', 'Mentor - tasks')

@section('content')
    <div id="app">
        <task-page></task-page>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
