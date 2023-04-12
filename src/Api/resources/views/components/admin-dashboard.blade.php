@vite(['resources/scss/admin-dashboard.scss'])

@extends('layouts.default')

@section('content')
    <x-sideBar />
    {{ print_r(session()->get('role')) }}
    <div class="text-danger">
        admin page
    </div>
@endsection
