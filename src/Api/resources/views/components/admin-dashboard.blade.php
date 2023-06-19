@vite(['resources/scss/user-dashboard.scss'])

@extends('layouts.default')

@section('content')
    <x-side-bar />
    <div class="container">
        <div id="nextAppointment" class="item box nextAppointment">
            U eerst volgende afspraak start op
        </div>

        <div id="numOfAppointments" class="item box numOfAppointments">
            U heeft nog 0 afspraken voor vandaag
        </div>
    </div>

    <script>
        const nextAppointment = document.getElementById('nextAppointment');
        const numOfAppointments = document.getElementById('numOfAppointments');

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

        fetch("{{ env('APP_URL') }}/api/reservations/getAdminNextReservation", settings)
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
                if (data.length != 0) {
                    data = data[0]
                    nextAppointment.innerHTML =
                        `U eerst volgende afspraak start op ${new Date(data.date + ' ' + data.start_time).toLocaleString('nl-NL')}`;
                } else {
                    nextAppointment.innerHTML = 'Er zijn geen boekingen meer voor vandaag'
                }
            })
            .catch(error => {
                console.log(error);
            });

        fetch("{{ env('APP_URL') }}/api/reservations/getTotalReservationsToday", settings)
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
                if (data) {
                    numOfAppointments.innerHTML =
                        `U heeft nog ${data} afspraken voor vandaag`;
                } else {
                    numOfAppointments.innerHTML = 'Er zijn geen boekingen meer voor vandaag'
                }
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection
