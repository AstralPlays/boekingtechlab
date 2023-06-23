@vite(['resources/scss/user-settings.scss'])

@extends('layouts.default')

@section('content')
    <x-side-bar />
    <div class="container">
        <div class="passwordInput">
            <span>Verander uw wachtwoord</span>
            <form onsubmit="changePassword(event)">
                <div class="input">
                    <label for="old_password">Oud Wachtwoord</label>
                    <input type="password" name="old_password" id="old_password" required>
                </div>
                <div class="input">
                    <label for="new_password">Nieuw paswoord</label>
                    <input type="password" name="new_password" id="new_password" required>
                </div>
                <div class="input">
                    <label for="confirm_password">Herhaal nieuw wachtwoord</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function changePassword(e) {
            e.preventDefault();

            if (
                e.target.old_password.value == '' ||
                e.target.new_password.value == '' ||
                e.target.confirm_password.value == ''
            ) {
                alert('Vul alle velden in');
                return;
            }

            if (e.target.new_password.value != e.target.confirm_password.value) {
                alert('Wachtwoorden komen niet overeen');
                return;
            }

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "_token": "{{ csrf_token() }}",
                    "old_password": e.target.old_password.value,
                    "new_password": e.target.new_password.value,
                    "confirm_password": e.target.confirm_password.value,
                })
            };

            fetch("{{ env('APP_URL') }}/api/changePassword", settings)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    if (data == 'success') {
                        window.location.href = "{{ env('APP_URL') }}/home";
                    } else {
                        alert(data);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    </script>
@endsection
