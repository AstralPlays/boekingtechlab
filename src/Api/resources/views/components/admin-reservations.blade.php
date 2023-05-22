@vite(['resources/scss/admin-reservations.scss'])

@extends('layouts.default')

@section('content')
    <x-sideBar />
    <div class="container">
        <div class="item nextAppointment">
            <input type="datetime-local" name="dateTime" onchange="getByDate(event)" value="{{ Date::now() }}">
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
                    </tr>
                </thead>
                <tbody id="dataContainer">

                </tbody>
                {{-- <div id="">Geen reserveringen gevonden</div> --}}
            </table>
        </div>
    </div>

    <script>
        // function setMaxWidth() {
        //     var boxes = document.querySelectorAll('.box');
        //     let maxWidth = 0;
        //     boxes.forEach(box => {
        //         const width = box.offsetWidth;
        //         if (width > maxWidth) {
        //             maxWidth = width;
        //         }
        //     });
        //     boxes.forEach(box => {
        //         box.style.maxWidth = `${maxWidth + 10}px`;
        //     });
        // }

        function getByDate(event) {
            const reservationsTable = document.getElementById('dataContainer');

            selectedDate = event.target.value;

            var url = 'http://localhost:8000/api/reservations/getByDateAdmin';

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
                            cell1.classList.add('box');
                            cell2.classList.add('box');
                            cell3.classList.add('box');
                            cell4.classList.add('box');
                            cell5.classList.add('box');
                            cell6.classList.add('box');
                            cell7.classList.add('box');
                            cell1.innerHTML = reservation.user_name;
                            cell2.innerHTML = reservation.user_email;
                            cell3.innerHTML = reservation.user_phone_number;
                            cell4.innerHTML = reservation.start_time;
                            cell5.innerHTML = reservation.end_time;
                            var call6_text = [];
                            reservation.materials.forEach(material => {
                                call6_text.push(material.name);
                            });
                            cell6.innerHTML = call6_text.toString();
                            var call7_text = [];
                            reservation.rooms.forEach(room => {
                                call7_text.push(room.name);
                            });
                            cell7.innerHTML = call7_text.toString();
                        });
                        setMaxWidth();
                    } else {
                        reservationsTable.innerHTML = 'Geen reserveringen gevonden';
                    }
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

        // getByDate();
    </script>
@endsection
