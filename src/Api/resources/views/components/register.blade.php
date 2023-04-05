@vite(['resources/scss/register.scss'])

@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="wrap">
            <form onsubmit="register(event)" id="form">
                <span class="form-title">Register</span>
                <div class="input-container" data-validate="Email is required">
                    <span class="label">Email</span>
                    <div class="input-wraper">
                        <i class="icon fa-solid fa-user"></i>
                        <input class="input" type="email" name="email" placeholder="Type your Email">
                        <span class="focus"></span>
                    </div>
                </div>
                <div class="input-container" data-validate="Password is required">
                    <span class="label">Password</span>
                    <div class="input-wraper">
                        <i class="icon fa-solid fa-lock"></i>
                        <input class="input" type="password" name="password" placeholder="Type your password">
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

    <script>
        function register(event) {
            event.preventDefault();
            var url = 'http://localhost:8000/api/user/register';
            var formData = new FormData(document.getElementById('form'));
            formData.append('_token', '{{ csrf_token() }}')

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    email: formData.get('email'),
                    password: formData.get('password'),
                }),
            };

            fetch(url, settings)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return response.then(error => {
                            throw error;
                        });
                    }
                })
                .then(data => {
                    console.log('data', data);
                    if (data == 'success') {
                        window.location.href = '{{ Route('home') }}';
                    }
                })
                .catch(error => {
                    console.log('error', error);
                });
        }
    </script>
@endsection
