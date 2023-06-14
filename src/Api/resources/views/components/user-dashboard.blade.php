@vite(['resources/scss/user-dashboard.scss'])

@extends('layouts.default')

@section('content')
    <x-side-Bar />
    <div class="container">
        <div class="item box nextAppointment">
            U eerst volgende afspraak start op <span id="nextAppointment"></span>
        </div>
    </div>

    <script>
        const nextAppointment = document.getElementById('nextAppointment');

        var settings = {
            method: "POST",
            timeout: 0,
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                "_token": "{{ csrf_token() }}"
            })
        };

        fetch('http://localhost:8000/api/reservations/getUserNextReservation', settings)
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
                nextAppointment.innerHTML = new Date(data.date + ' ' + data.start_time).toLocaleString('nl-NL');
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection
