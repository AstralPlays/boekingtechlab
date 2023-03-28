@vite(['resources/scss/register.scss'])

@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="wrap">
            <form> {{-- need milan help --}}
                <span class="form-title">Register</span>
                <div class="input-container" data-validate="Email is required">
                    <span class="label">Email</span>
                    <div class="input-wraper">
                        <i class="icon fa-solid fa-user"></i>
                        <input class="input" type="email" name="Email" placeholder="Type your Email">
                        <span class="focus"></span>
                    </div>
                </div>
                <div class="input-container" data-validate="Password is required">
                    <span class="label">Password</span>
                    <div class="input-wraper">
                        <i class="icon fa-solid fa-lock"></i>
                        <input class="input" type="password" name="pass" placeholder="Type your password">
                        <span class="focus"></span>
                    </div>
                </div>
                <div class="submit-container">
                    <div class="submit-wraper">
                        <button class="submit-button" type="submit">Register</button>
                    </div>
                </div>
                <div class="sign-up">
                    <a href="{{ URL::route('login') }}">Or Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection
