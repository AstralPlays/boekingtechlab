@vite(['resources/scss/user-reservations.scss'])

@extends('layouts.default')

@section('content')
    <x-side-Bar />
    <div class="container">
        <div class="item nextAppointment">
            <table class="reservations" id="reservations">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>telefoonnummer</th>
                        <th>datum</th>
                        <th>Start Tijd</th>
                        <th>Eind Tijd</th>
                        <th>materiaal</th>
                        <th>lokaal</th>
                        <th>staat</th>
                        <th>opties</th>
                    </tr>
                </thead>
                <tbody id="dataContainer">

                </tbody>
                {{-- <div id="">Geen reserveringen gevonden</div> --}}
            </table>
        </div>
    </div>

    <script>
        const reservationsTable = document.getElementById('dataContainer');

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

        fetch("{{ env('APP_URL') }}/api/reservations/getUserReservations", settings)
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
                reservationsTable.innerHTML = '';
                data.forEach(element => {
                    var materials = [];
                    element.materials.forEach(material => {
                        materials.push(material.name + ` (${material.quantity})`);
                    });
                    var rooms = [];
                    element.rooms.forEach(room => {
                        rooms.push(room.name);
                    });
                    reservationsTable.innerHTML += `
							<tr>
								<td>${element.user_name}</td>
								<td>${element.user_email}</td>
								<td>${element.user_phone_number}</td>
								<td>${element.date}</td>
								<td>${element.start_time}</td>
								<td>${element.end_time}</td>
								<td>${materials.join('<br>')}</td>
								<td>${rooms.join('<br>')}</td>
								<td class="${element.state}">${element.state}</td>
								<td><button onclick="removeReservation(this.value)" value="${element.id}">Verwijder</button></td>
							</tr>
						`;
                });
            })
            .catch(error => {
                console.log(error);
            });

        function removeReservation(id) {
            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "_token": "{{ csrf_token() }}",
                    "id": id
                })
            };

            fetch("{{ env('APP_URL') }}/api/reservations/removeUserReservation", settings)
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
                    if (data == 'success') {
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    </script>
@endsection
