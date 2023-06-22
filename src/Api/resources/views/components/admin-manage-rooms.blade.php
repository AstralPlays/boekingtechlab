@vite(['resources/scss/admin-manage-rooms.scss', 'resources/js/swiper.js'])

@extends('layouts.default')

@section('content')
    <x-side-bar />
    <div class="container">
        <div class="wrapper">
            <div class="addRoom">
                <span>Nieuwe lokaal aanmaken</span>
                <form onsubmit="uploadRoom(event)">
                    <div class="input">
                        <label for="roomName">Naam</label>
                        <input type="text" name="roomName" id="roomName" required>
                    </div>
                    <div class="input">
                        <label for="image">foto</label>
                        <input type="file" name="image" id="image" accept="image/*" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </form>
            </div>

            <div class="rooms">
                <div class="swiper">
                    <div class="swiper-wrapper" id="rooms-wrapper">
                        {{-- this section will be looped --}}

                        {{-- this section will be looped --}}
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <!-- <div class="swiper-scrollbar"></div> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function uploadRoom(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('roomName', document.getElementById('roomName').value);
            formData.append('image', document.getElementById('image').files[0]);

            var settings = {
                method: "POST",
                timeout: 0,
                body: formData
            };

            fetch("{{ env('APP_URL') }}/api/admin/addRoom", settings)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    if (data == 'success') {
                        alert('Kamer toegevoegd');
                    } else {
                        alert(data);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }

        function addRooms(rooms) {
            document.getElementById('rooms-wrapper').innerHTML = '';
            rooms.forEach((item, i) => {
                document.getElementById('rooms-wrapper').innerHTML += `
					<div class="swiper-slide" id="room${item.id}">
                        <div class="swiper_item">
                            <span>${item.name}</span>
                            <img src="{{ env('APP_URL') }}/images/rooms/${item.image}" alt="">
                            <div class="controllers">
								<button type="button" onclick="removeRoom(${item.id})">Remove</button>
                            </div>
                        </div>
                    </div>
				`;
            });
            var checkbox = document.getElementsByClassName('rooms');
            for (var i = 0; i < checkbox.length; i++) {
                checkbox[i].addEventListener('change', function(event) {
                    getBlockedTimes();
                });
            }
        }

        function removeRoom(id) {
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

            fetch("{{ env('APP_URL') }}/api/admin/removeRoom", settings)
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
                        document.getElementById('room' + id).remove();
                    } else {
                        alert(data);
                    }
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

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

        fetch("{{ env('APP_URL') }}/api/room/getRooms", settings)
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
                addRooms(data);
            })
            .catch(error => {
                console.log('error', error);
            });
    </script>
@endsection
