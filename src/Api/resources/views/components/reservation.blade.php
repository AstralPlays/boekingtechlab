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
                                <label for="">Voornaam</label>
                                <input type="text" id="" name="firstName">
                            </div>
                            <div class="userInfo_item_part">
                                <label for="">Achternaam</label>
                                <input type="text" id="" name="lastName">
                            </div>
                        </div>
                        <div class="userInfo_item">
                            <div class="userInfo_item_part">
                                <label for="">Telefoonnummer</label>
                                <input type="text" id="" name="phone">
                            </div>
                            <div class="userInfo_item_part">
                                <label for="">Adres</label>
                                <input type="text" id="" name="address">
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
                    <div class="mats_picker">
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
                <div class="formPart">
                    <div class="date_picker">
                        <select name="month" onchange="changeMonth(event)">
                            <option value="1" @if (date('m') == 1) selected @endif>Januari</option>
                            <option value="2" @if (date('m') == 2) selected @endif>Februari</option>
                            <option value="3" @if (date('m') == 3) selected @endif>Maart</option>
                            <option value="4" @if (date('m') == 4) selected @endif>April</option>
                            <option value="5" @if (date('m') == 5) selected @endif>Mei</option>
                            <option value="6" @if (date('m') == 6) selected @endif>Juni</option>
                            <option value="7" @if (date('m') == 7) selected @endif>Juli</option>
                            <option value="8" @if (date('m') == 8) selected @endif>Augustus</option>
                            <option value="9" @if (date('m') == 9) selected @endif>September</option>
                            <option value="10" @if (date('m') == 10) selected @endif>Oktober</option>
                            <option value="11" @if (date('m') == 11) selected @endif>November</option>
                            <option value="12" @if (date('m') == 12) selected @endif>December</option>
                        </select>
                        <div class="dates_container" id="dates_container">
                            {{-- Code will go here by javascript --}}
                        </div>
                    </div>
                </div>
                <div class="formPart">
                    <div class="time_picker">
                        <div class="times_container" id="times_container">
                            {{-- Code will go here by javascript --}}
                        </div>
                    </div>
                </div>
                <div class="submin_container">
                    <button type="button" onclick="submity()">submit</button>
                </div>
                <input type="text" name="array[room_1]" value="" /><br>
                <input type="text" name="array[room_2]" value="" /><br>
                <input type="text" name="array[room_3]" value="" /><br>
                <input type="text" name="array[room_4]" value="" /><br>
                <input type="text" name="array[room_5]" value="" /><br>
                <input type="text" name="array[room_6]" value="" /><br>
                <input type="text" name="array[room_7]" value="" /><br>
                <input type="text" name="array[room_8]" value="" /><br>
                <input type="text" name="array[room_9]" value="" /><br>
                <input type="text" name="array[room_10]" value="" /><br>
                <input type="text" name="array[room_11]" value="" /><br>
                <input type="text" name="array[room_12]" value="" /><br>
                <input type="text" name="array[room_13]" value="" /><br>
                <input type="text" name="array[room_14]" value="" /><br>
                <input type="text" name="array[room_15]" value="" /><br>
            </form>
        </div>
    </div>

    <script>
        var form;
        var dateTable = [];
        var timeTable = [];
        var sDate = new Date(new Date().setDate(1));
        var eDate = new Date(new Date().setDate(this.daysInMonth(undefined, undefined, this.sDate)));
        var blockedTimes = [];
        var selectedDate;
        var selectedTimes = [];
        var selectedRooms = [];
        var selectedMats = [];
        var rooms = [{
            id: 1,
            title: 'Lokaal 1',
            image: 'logo.png'
        }, {
            id: 2,
            title: 'Lokaal 2',
            image: 'logo.png'
        }, {
            id: 3,
            title: 'Lokaal 3',
            image: 'logo.png'
        }, {
            id: 4,
            title: 'Lokaal 4',
            image: 'logo.png'
        }, {
            id: 5,
            title: 'Lokaal 5',
            image: 'logo.png'
        }];
        var mats = [{
            id: 6,
            title: 'Materiaal 1',
            image: 'logo.png',
            quantity: 1
        }, {
            id: 7,
            title: 'Materiaal 2',
            image: 'logo.png',
            quantity: 3
        }, {
            id: 8,
            title: 'Materiaal 3',
            image: 'logo.png',
            quantity: 5
        }, {
            id: 9,
            title: 'Materiaal 4',
            image: 'logo.png',
            quantity: 7
        }, {
            id: 10,
            title: 'Materiaal 5',
            image: 'logo.png',
            quantity: 9
        }];
        let timeElement = []

        createTimeTable('9:00', '17:00', 15);
        createDateTable(sDate, eDate);

        function daysInMonth(month, year, date) {
            if (month && year) {
                return new Date(year, month, 0).getDate();
            } else if (date) {
                return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
            }
            return;
        }

        function changeMonth(event) {
            const month = parseInt(event.target.value) - 1;
            sDate = new Date(new Date(new Date().setMonth(month)).setDate(1)); // 0 - 11 (January - December)
            eDate = new Date(new Date(new Date().setMonth(month)).setDate(daysInMonth(undefined, undefined,
                sDate))); // 0 - 11 (January - December)
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
                input.id = 'date_picker_' + i;
                input.value = item.toLocaleDateString([], {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                });
                input.onclick = function() {
                    getBlockedTimes(event);
                };

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

        function addRooms() {
            document.getElementById('rooms-wrapper').innerHTML = '';
            rooms.forEach((item, i) => {
                document.getElementById('rooms-wrapper').innerHTML += `
					<div class="swiper-slide">
                        <div class="swiper_item">
                            <span>${item.title}</span>
                            <img src="{{ Vite::asset('resources/images/${item.image}') }}" alt="">
                            <div class="controllers">
                                <input type="checkbox" class="btn_check" name="rooms[${item.id}]">
                            </div>
                        </div>
                    </div>
				`;

            });
        }
        addRooms();

        function addMats() {
            document.getElementById('mats-wrapper').innerHTML = '';
            mats.forEach((item, i) => {
                document.getElementById('mats-wrapper').innerHTML += `
					<div class="swiper-slide">
						<div class="swiper_item">
							<span>${item.title}</span>
							<img src="{{ Vite::asset('resources/images/${item.image}') }}" alt="">
							<div class="controllers">
								<button type="button" class="btn_remove" onclick="decrement(event)">
									<i class="icon fa-solid fa-minus"></i>
									</button>
									<input type="number" name="mats[${item.id}]" id="quantity${i}" min="0"
									max="${item.quantity}" readonly value="0">
									<button type="button" class="btn_add" onclick="increment(event)">
										<i class="icon fa-solid fa-plus"></i>
									</button>
							</div>
						</div>
					</div>
				`;

            });
        }
        addMats();

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
                } else {
                    for (let i = 0; i < timeElement.length; i++) {
                        timeElement.at(i).disabled = false;
                    }
                }

                blockTime(blockedTimes);
            }, 0);

            blockTime(blockedTimes);
        }

        function submity() {
            if (document.querySelector('input[name="date"]:checked')) {
                var selectedDate = document.querySelector('input[name="date"]:checked').value
            }

            var url = 'http://localhost:8000/api/reservations/create';

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "start_time": selectedTimes[0]['start_time'],
                    "end_time": selectedTimes[selectedTimes.length - 1]['end_time'],
                    "date": selectedDate,
                    "rooms_id": getSelectedRooms(),
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
                    // document.location.href = "{{ Route('reservation') }}";
                    console.log('data', data);
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

        function getBlockedTimes(event) {
            blockTime(blockedTimes);

            if (selectedDate === event.target.value) {
                return;
            }

            blockedTimes = [];
            selectedDate = event.target.value;

            var url = 'http://localhost:8000/api/reservations/getbydate';

            var settings = {
                method: "POST",
                timeout: 0,
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "date": selectedDate,
                    "rooms_id": getSelectedRooms(),
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
                    blockedTimes = data;
                    blockTime(blockedTimes);
                    var htmlElements = document.querySelectorAll('input[type="checkbox"].time_picker');
                    htmlElements.forEach(element => {
                        element.checked = false;
                        element.disabled = false;
                        selectedTimes = [];
                    });
                })
                .catch(error => {
                    console.log('error', error);
                });
        }

        function blockTime(data) {
            var htmlElements = document.querySelectorAll('input[type="checkbox"][reserved=true].time_picker');
            htmlElements.forEach(element => {
                element.disabled = false;
                element.setAttribute('reserved', 'false');
                element.parentElement.getElementsByTagName('label')[0].innerHTML = String(JSON.parse(element.value)[
                        'start_time']).slice(0, -3) + ' <br> ' + String(JSON.parse(element.value)['end_time'])
                    .slice(
                        0, -3);
            });
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
                    var roomName = parseInt(pair[0].substring(i, pair[0].length - 1)); // Extract the room name
                    var data = {};
                    data[roomName] = pair[1]; // Create an object with the room name and input value
                    dataArray.push(roomName); // Add the object to the array
                }
            }
            return dataArray; // Output the array of objects to the console
        }

        function getSelectedMats() {
            var FD = new FormData(document.getElementById('form'));
            var dataArray = [];
            for (var pair of FD.entries()) {
                if (pair[0].startsWith("mats[") && pair[1] != "0") { // Check if the input name starts with "array[room_"
                    var i = pair[0].indexOf("[") + 1
                    var roomName = parseInt(pair[0].substring(i, pair[0].length - 1)); // Extract the room name
                    var data = {
                        'mat_id': roomName,
                        'amount': pair[1]
                    };
                    dataArray.push(data); // Add the object to the array
                }
            }
            return dataArray; // Output the array of objects to the console
        }
    </script>
@endsection
