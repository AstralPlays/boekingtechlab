@vite(['resources/scss/admin-reservations.scss'])

@extends('layouts.default')

@section('content')
    <x-sideBar />
    <div class="container">
        <div class="item nextAppointment">
            <input type="datetime-local" name="dateTime" onchange="getByDate(this.value)" value="{{ Date::now() }}">
            <table class="reservations" id="reservations">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>telefoonnummer</th>
                        <th>Start Tijd</th>
                        <th>Eind Tijd</th>
                        <th>materiaal</th>
                        <th>lokaal</th>
                        <th>staat</th>
                    </tr>
                </thead>
                <tbody id="dataContainer">

                </tbody>
                {{-- <div id="">Geen reserveringen gevonden</div> --}}
            </table>
        </div>
    </div>

    <script>
        function getByDate(selectedDate) {
            const reservationsTable = document.getElementById('dataContainer');

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "date": new Date(selectedDate).toLocaleDateString([], {
                        month: '2-digit',
                        day: '2-digit',
                        year: 'numeric',
                    }),
                    "_token": "{{ csrf_token() }}"
                })
            };

            fetch('http://localhost:8000/api/reservations/getByDateAdmin', settings)
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
                    if (data.length > 0) {
                        reservationsTable.innerHTML = '';
                        data.forEach(reservation => {
                            const row = reservationsTable.insertRow(-1);
                            const cell1 = row.insertCell(0);
                            const cell2 = row.insertCell(1);
                            const cell3 = row.insertCell(2);
                            const cell4 = row.insertCell(3);
                            const cell5 = row.insertCell(4);
                            const cell6 = row.insertCell(5);
                            const cell7 = row.insertCell(6);
                            const cell8 = row.insertCell(7);
                            cell1.classList.add('box');
                            cell2.classList.add('box');
                            cell3.classList.add('box');
                            cell4.classList.add('box');
                            cell5.classList.add('box');
                            cell6.classList.add('box');
                            cell7.classList.add('box');
                            cell8.classList.add('box');
                            cell1.innerHTML = reservation.user_name;
                            cell2.innerHTML = reservation.user_email;
                            cell3.innerHTML = reservation.user_phone_number;
                            cell4.innerHTML = reservation.start_time;
                            cell5.innerHTML = reservation.end_time;
                            var call6_text = [];
                            reservation.materials.forEach(material => {
                                call6_text.push(material.name + ` (${material.quantity})`);
                            });
                            cell6.innerHTML = call6_text.join('<br>');
                            var call7_text = [];
                            reservation.rooms.forEach(room => {
                                call7_text.push(room.name);
                            });
                            cell7.innerHTML = call7_text.join('<br>');
                            var x = document.createElement('SELECT');
                            x.setAttribute('name', 'state')
                            x.setAttribute('onchange', `updateState(${reservation.id},this.value)`);
                            var state = ['pending', 'approved', 'rejected'];
                            state.forEach(element => {
                                var option = document.createElement('option');
                                option.text = element;
                                option.value = element;
                                if (reservation.state == element) {
                                    option.selected = true;
                                }
                                x.add(option);
                            });
                            cell8.classList.add('centerCheckbox');
                            cell8.append(x);
                        });
                    } else {
                        reservationsTable.innerHTML = 'Geen reserveringen gevonden';
                    }
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

        function updateState(id, value) {
            event.preventDefault();

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "id": id,
                    "state": value,
                    "_token": "{{ csrf_token() }}"
                })
            };

            fetch('http://localhost:8000/api/reservations/changeState', settings)
                .then(response => {
                    return response.json();
                })
                .then(data => {})
                .catch(error => {
                    console.log('error', error);
                });
        }

        getByDate(new Date());
    </script>
@endsection
