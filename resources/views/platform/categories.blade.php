@extends('layouts.layout')

@section('title', 'Mentor - categories')

@section('content')
    <div id="app" class="container wrapper flex-grow-1 mt-3 mb-3">
        <div class="text-center">
            <img src="{{ asset('images/smile.png') }}" width="600" height="300" id="category-image">
        </div>
        <category-page></category-page>
    </div>
@endsection
