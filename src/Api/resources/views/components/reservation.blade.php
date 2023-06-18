@vite(['resources/scss/reservation.scss', 'resources/js/reservation.js'])

@extends('layouts.default')

@section('content')
    {{-- <script>
        import Swiper from 'swiper';
    </script> --}}
    <div class="container">
        <div class="wrapper">
            <form id="form">
                <div class="formPart">
                    <div class="userInfo">
                        <div class="userInfo_item">
                            <div class="userInfo_item_part">
                                <label for="">Naam</label>
                                <input type="text" id="" name="name">
                            </div>
                        </div>
                        <div class="userInfo_item">
                            <div class="userInfo_item_part">
                                <label for="">Email</label>
                                <input type="text" id="" name="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="formPart">
                    <div class="room_picker">
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
                <div class="formPart">
                    <div class="date_picker">
                        <select name="month" onchange="changeMonth(this.value)">
                            <option value="0" @if (date('m') == 1) selected @endif>Januari</option>
                            <option value="1" @if (date('m') == 2) selected @endif>Februari</option>
                            <option value="2" @if (date('m') == 3) selected @endif>Maart</option>
                            <option value="3" @if (date('m') == 4) selected @endif>April</option>
                            <option value="4" @if (date('m') == 5) selected @endif>Mei</option>
                            <option value="5" @if (date('m') == 6) selected @endif>Juni</option>
                            <option value="6" @if (date('m') == 7) selected @endif>Juli</option>
                            <option value="7" @if (date('m') == 8) selected @endif>Augustus</option>
                            <option value="8" @if (date('m') == 9) selected @endif>September</option>
                            <option value="9" @if (date('m') == 10) selected @endif>Oktober</option>
                            <option value="10" @if (date('m') == 11) selected @endif>November</option>
                            <option value="11" @if (date('m') == 12) selected @endif>December</option>
                        </select>
                        <div class="dates_container" id="dates_container">
                            {{-- Code will go here by javascript --}}
                        </div>
                    </div>
                </div>
                <div class="formPart">
                    <div id="time_picker" class="time_picker">
                        <div class="times_container" id="times_container">
                            {{-- Code will go here by javascript --}}
                        </div>
                    </div>
                </div>
                <div class="formPart">
                    <div id="material_picker" class="mats_picker">
                        <div class="swiper">
                            <div class="swiper-wrapper" id="mats-wrapper">
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
                <div class="submin_container">
                    <button id="submit" type="button" onclick="submity()">submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var form;
        var dateTable = [];
        var timeTable = [];
        var sDate
        var eDate;
        var blockedTimes = [];
        var selectedTimes = [];
        var selectedRooms = [];
        var selectedMats = [];
        let timeElement = []

        createTimeTable('9:00', '17:00', 15);
        changeMonth(new Date().getMonth());

        function daysInMonth(date) {
            return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
        }

        function changeMonth(month) {
            const date = new Date();
            sDate = new Date(date.getFullYear(), month, 1);
            eDate = new Date(date.getFullYear(), month, daysInMonth(sDate));

            createDateTable(sDate, eDate);
        }

        function createDateTable(DateStart, DateEnd) {
            dateTable = [];
            let tmpDate = DateStart
            while (tmpDate <= DateEnd) {
                let newDate = new Date(tmpDate);
                dateTable.push(newDate);
                tmpDate.setDate(tmpDate.getDate() + 1);
            }
            addDateTable();
        }

        function createTimeTable(timeStart, timeEnd, intervalInMinuts) {
            timeTable = [];
            const startTime = new Date('01/01/2000 ' + timeStart);
            const endTime = new Date('01/01/2000 ' + timeEnd);
            while (startTime <= endTime) {
                const currentdate = new Date(startTime);
                timeTable.push(currentdate.toLocaleTimeString([], {
                    hour12: false,
                    hour: "2-digit",
                    minute: "2-digit",
                    second: "2-digit"
                }));
                startTime.setMinutes(startTime.getMinutes() + intervalInMinuts);
            }
            addTimeTable();
        }

        function addDateTable() {
            let datesContainer = document.getElementById('dates_container');
            datesContainer.innerHTML = '';

            dateTable.forEach((item, i) => {
                let div = document.createElement('div');
                div.className = 'date_picker_item';

                let input = document.createElement('input');
                input.type = 'radio';
                input.setAttribute('name', 'date');
                input.classList.add('date_picker_input');
                input.id = 'date_picker_' + i;
                input.value = item.toLocaleDateString([], {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                });

                let label = document.createElement('label');
                label.className = 'whatever';
                label.setAttribute('for', 'date_picker_' + i);
                label.innerHTML = item.toLocaleDateString([], {
                    day: '2-digit'
                });

                div.appendChild(input);
                div.appendChild(label);

                datesContainer.appendChild(div);
            });
        }

        function addTimeTable() {
            let timesContainer = document.getElementById('times_container');
            timesContainer.innerHTML = '';

            for (let i = 0; i < (timeTable.length - 1); i++) {
                const item = timeTable[i];

                let div = document.createElement('div');
                div.className = 'time_picker_item';

                let input = document.createElement('input');
                input.type = 'checkbox';
                input.setAttribute('name', 'time_picker_' + i);
                input.setAttribute('reserved', false);
                input.id = 'time_picker_' + i;
                input.className = 'time_picker';
                input.value = JSON.stringify({
                    start_time: item,
                    end_time: timeTable[i + 1]
                });
                input.onchange = function() {
                    checkButtons(event);
                    console.log(123);
                };

                let label = document.createElement('label');
                label.className = 'whatever';
                label.setAttribute('for', 'time_picker_' + i);
                label.innerHTML = item.slice(0, -3) + ' <br> ' + timeTable[i + 1].slice(0, -3);

                timeElement.push(input)

                div.appendChild(input);
                div.appendChild(label);

                timesContainer.appendChild(div);
            }
        }

        function addRooms(rooms) {
            document.getElementById('rooms-wrapper').innerHTML = '';
            rooms.forEach((item, i) => {
                document.getElementById('rooms-wrapper').innerHTML += `
					<div class="swiper-slide">
                        <div class="swiper_item">
                            <span>${item.name}</span>
                            <img src="{{ env('APP_URL') }}/images/${item.image}" alt="">
                            <div class="controllers">
                                <input type="checkbox" class="btn_check rooms" name="rooms[${item.id}]" id="room${i}">
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

        function addMats(mats) {
            document.getElementById('mats-wrapper').innerHTML = '';
            mats.forEach((item, i) => {
                document.getElementById('mats-wrapper').innerHTML += `
					<div class="swiper-slide">
						<div class="swiper_item">
							<span>${item.name}</span>
							<img src="{{ env('APP_URL') }}/images/${item.image}" alt="">
							<div class="controllers">
								<button type="button" class="btn_remove" onclick="decrement(event)">
									<i class="icon fa-solid fa-minus"></i>
									</button>
									<input class="materials" type="number" name="mats[${item.id}]" id="quantity${i}" min="0"
									max="${item.quantity}" readonly value="0">
									<span>${item.quantity}</span>
									<button type="button" class="btn_add" onclick="increment(event)">
										<i class="icon fa-solid fa-plus"></i>
									</button>
							</div>
						</div>
					</div>
				`;
            });
            var checkbox = document.getElementsByClassName('materials');
            for (var i = 0; i < checkbox.length; i++) {
                checkbox[i].addEventListener('change', function(event) {
                    getBlockedTimes();
                });
            }
        }

        function checkButtons(event) {
            blockTime(blockedTimes);

            setTimeout(() => {
                blockTime(blockedTimes);

                selectedTimes = [];
                for (let i = 0; i < timeElement.length; i++) {
                    if (timeElement.at(i).checked) {
                        selectedTimes.push(JSON.parse(timeElement.at(i).value));
                    }
                }
                if (selectedTimes.length > 0) {
                    for (let i = 0; i < timeElement.length; i++) {
                        timeElement.at(i).disabled = true;
                    }

                    for (let i = 0; i < timeElement.length; i++) {
                        if (timeElement.at(i).checked) {
                            timeElement.at(i).disabled = false;

                            if (timeElement.at(i - 1) && i !== 0) {
                                timeElement.at(i - 1).disabled = false;
                            }

                            if (timeElement.at(i + 1) && i !== (timeElement.length - 1)) {
                                timeElement.at(i + 1).disabled = false;
                            }
                        }

                        if (i !== 0 && timeElement.at(i - 1)?.checked && timeElement.at(i + 1)
                            ?.checked) {
                            timeElement.at(i).checked = true;
                        }
                    }
                    getMaterialsWithTime();
                } else {
                    for (let i = 0; i < timeElement.length; i++) {
                        timeElement.at(i).disabled = false;
                    }
                    getMaterials();
                }

                blockTime(blockedTimes);
            }, 0);

            blockTime(blockedTimes);
        }

        function submity() {
            var name = document.querySelector('input[name="name"]').value;
            var email = document.querySelector('input[name="email"]').value;
            var date = document.querySelector('input[name="date"]:checked').value;
            var start_time = selectedTimes[0]['start_time'];
            var end_time = selectedTimes[selectedTimes.length - 1]['end_time'];
            var rooms = getSelectedRooms();
            var materials = getSelectedMats();

            if (date == '' ||
                start_time == '' ||
                end_time == '') {
                alert('Vul alle velden in');
                return;
            }
            submitState(false);
            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "name": name,
                    "email": email,
                    "date": date,
                    "start_time": start_time,
                    "end_time": end_time,
                    "rooms": rooms,
                    "materials": materials,
                    "_token": "{{ csrf_token() }}"
                })
            };

            fetch('{{ env('APP_URL') }}/api/reservations/create', settings)
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
                    document.location.href = "{{ Route('reservation') }}";
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

        timeSelectionState(false);
        materialSelectionState(false);

        function timeSelectionState(state) {
            const time_picker = document.getElementById('time_picker');
            if (state) {
                // remove the gray overlay from the time picker
                time_picker.classList.remove('blocked');
            } else {
                // add a gray overlay to the time picker
                time_picker.classList.add('blocked');
            }
            // change the submit button state
            submitState(state);
        }

        function materialSelectionState(state) {
            const material_picker = document.getElementById('material_picker');
            if (state) {
                // remove the gray overlay from the material picker
                material_picker.classList.remove('blocked');
            } else {
                // add a gray overlay to the material picker
                material_picker.classList.add('blocked');
            }
            // change the submit button state
            submitState(state);
        }

        function submitState(state) {
            const submitButton = document.getElementById('submit');
            if (state) {
                submitButton.disabled = false;
                submitButton.classList.remove('blocked');
            } else {
                submitButton.disabled = true;
                submitButton.classList.add('blocked');
            }
        }

        var selectedDate = null;

        document.querySelectorAll('.date_picker_item').forEach((item, i) => {
            item.addEventListener('change', (event) => {
                selectedDate = event.target.value;
                getBlockedTimes(selectedDate);
            });
        });

        function getBlockedTimes() {
            console.log('getBlockedTimes');
            blockedTimes = [];
            unblockAll();
            timeSelectionState(false);
            materialSelectionState(false);
            if (selectedDate == null) {
                return;
            }
            if (getSelectedRooms().length == 0) {
                return;
            }

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "date": selectedDate,
                    "rooms": getSelectedRooms(),
                    "materials": getSelectedMats(),
                    "_token": "{{ csrf_token() }}"
                })
            };

            fetch('{{ env('APP_URL') }}/api/reservations/getbydate', settings)
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
                    blockedTimes = data;
                    blockTime(blockedTimes);
                    var htmlElements = document.querySelectorAll('input[type="checkbox"].time_picker');
                    htmlElements.forEach(element => {
                        element.checked = false;
                        element.disabled = false;
                        selectedTimes = [];
                    });
                    timeSelectionState(true);
                    materialSelectionState(true);
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

        function unblockAll() {
            var htmlElements = document.querySelectorAll('input[type="checkbox"][reserved=true].time_picker');
            htmlElements.forEach(element => {
                element.disabled = false;
                element.setAttribute('reserved', 'false');
                element.checked = false;
                element.parentElement.getElementsByTagName('label')[0].innerHTML = String(
                        JSON.parse(element.value)['start_time'])
                    .slice(0, -3) + ' <br> ' + String(
                        JSON.parse(element.value)['end_time'])
                    .slice(0, -3);
            });
        }

        function blockTime(data) {
            unblockAll();
            var htmlElements = document.querySelectorAll('input[type="checkbox"].time_picker');
            timeTable.forEach((time, key) => {
                data.forEach(blocked => {
                    if (
                        (new Date('01/01/2000 ' + time) <= new Date('01/01/2000 ' + blocked.start_time) &&
                            new Date('01/01/2000 ' + timeTable[key + 1]) >= new Date('01/01/2000 ' + blocked
                                .end_time)) ||
                        (new Date('01/01/2000 ' + time) >= new Date('01/01/2000 ' + blocked.start_time) &&
                            new Date('01/01/2000 ' + timeTable[key + 1]) <= new Date('01/01/2000 ' + blocked
                                .end_time))
                    ) {
                        htmlElements[key].disabled = true;
                        htmlElements[key].setAttribute('reserved', 'true');
                        htmlElements[key].checked = false;
                        htmlElements[key].parentElement.getElementsByTagName('label')[0].innerText =
                            'Bezet';
                    }
                })
            });
        }

        function increment(event) {
            event.currentTarget.parentElement.getElementsByTagName('input')[0].stepUp();
        }

        function decrement(event) {
            event.currentTarget.parentElement.getElementsByTagName('input')[0].stepDown();
        }

        function getSelectedRooms() {
            var FD = new FormData(document.getElementById('form'));
            var dataArray = [];
            for (var pair of FD.entries()) {
                if (pair[0].startsWith("rooms[") && pair[1]) { // Check if the input name starts with "array[room_"
                    var i = pair[0].indexOf("[") + 1
                    var roomId = parseInt(pair[0].substring(i, pair[0].length - 1)); // Extract the room name
                    var data = {};
                    data[roomId] = pair[1]; // Create an object with the room name and input value
                    dataArray.push(roomId); // Add the object to the array
                }
            }
            return dataArray; // Output the array of objects to the console
        }

        function getSelectedMats() {
            var FD = new FormData(document.getElementById('form'));
            var dataArray = [];
            for (var pair of FD.entries()) {
                if (pair[0].startsWith("mats[") &&
                    pair[1] != "0") { // Check if the input name starts with "array[material_"
                    var i = pair[0].indexOf("[") + 1
                    var materialId = parseInt(pair[0].substring(i, pair[0].length - 1)); // Extract the material name
                    var data = {
                        'material_id': materialId,
                        'quantity': pair[1]
                    };
                    dataArray.push(data); // Add the object to the array
                }
            }
            return dataArray; // Output the array of objects to the console
        }

        function getRoomsAndMaterials() {
            getRooms();
            getMaterials();
        }

        function getRooms() {
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

            fetch('{{ env('APP_URL') }}/api/reservations/getRooms', settings)
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
        }

        function getMaterials() {
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

            fetch('{{ env('APP_URL') }}/api/reservations/getMaterials', settings)
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
                    addMats(data);
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

        function getMaterialsWithTime() {
            var date = document.querySelector('input[name="date"]:checked').value;
            var start_time = selectedTimes[0]['start_time'];
            var end_time = selectedTimes[selectedTimes.length - 1]['end_time'];

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "date": date,
                    "start_time": start_time,
                    "end_time": end_time,
                    "_token": "{{ csrf_token() }}"
                })
            };

            fetch('{{ env('APP_URL') }}/api/reservations/getReservedMaterials', settings)
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
                    addMats(data);
                })
                .catch(error => {
                    console.log('error', error);
                });
        }
        getRoomsAndMaterials();
    </script>
@endsection
