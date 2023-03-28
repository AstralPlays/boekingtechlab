@vite(['resources/scss/home-page.scss'])

@extends('layouts.default')

@section('content')
    <div class="text-danger">
        {{ $text }}
    </div>
@endsection
