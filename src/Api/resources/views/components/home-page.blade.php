@vite(['resources/scss/home-page.scss'])

@extends('layouts.default')

@section('content')

{{ session()->get('user_id') }}
    <div class="text-danger">
        {{ $text }}
    </div>
@endsection
