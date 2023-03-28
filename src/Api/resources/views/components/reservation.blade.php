@vite(['resources/scss/reservation.scss', 'resources/js/reservation.js'])

@extends('layouts.default')

@section('content')
    {{-- <script>
        import Swiper from 'swiper';
    </script> --}}
    <div class="container">
        <div class="wrapper">
            <form id="form"> {{-- need milan help --}}
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
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper_item">
                                        <span>item 1</span>
                                        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
                                        <div class="controllers" *ngIf="selectBox" [formArrayName]="controlName">
                                            <input type="checkbox" class="btn_check">
                                        </div>
                                    </div>
                                </div>
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
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper_item">
                                        <span>item 1</span>
                                        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
                                        <div class="controllers" *ngIf="!selectBox">
                                            <button type="button" class="btn_add" (click)="increaseValue(i)">
                                                <i class="icon fa-solid fa-plus"></i>
                                            </button>
                                            <span>0</span>
                                            <button type="button" class="btn_remove" (click)="decreaseValue(i)">
                                                <i class="icon fa-solid fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                            <option value="5" @if (date('m') == 5) selected @endif>Kunnen</option>
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

                            <div class="date_picker_item">
                                <input type="radio" id="i" name="date" value="date" />
                                <label class="whatever"
                                    for="i">{{ \Carbon\Carbon::parse('2020')->format('d') }}</label>
                            </div>

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
            </form>
        </div>
    </div>

    <script>
        var form;
        var dateTable = [];
        var timeTable = [];
        var sDate = new Date(new Date().setDate(1));
        var eDate = new Date(new Date().setDate(this.daysInMonth(undefined, undefined, this.sDate)));
        var selectedTimes = [];
        var selectedRooms = [];
        var selectedMats = [];
        var rooms = [{
            title: 'Lokaal 1',
            image: 'logo.png'
        }, {
            title: 'Lokaal 2',
            image: 'logo.png'
        }, {
            title: 'Lokaal 3',
            image: 'logo.png'
        }, {
            title: 'Lokaal 4',
            image: 'logo.png'
        }, {
            title: 'Lokaal 5',
            image: 'logo.png'
        }];
        var mats = [{
            title: 'Materiaal 1',
            image: 'logo.png'
        }, {
            title: 'Materiaal 2',
            image: 'logo.png'
        }, {
            title: 'Materiaal 3',
            image: 'logo.png'
        }, {
            title: 'Materiaal 4',
            image: 'logo.png'
        }, {
            title: 'Materiaal 5',
            image: 'logo.png'
        }];
        let getTimes = []
        let getDates = []

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
                    minute: "2-digit"
                }));
                startTime.setMinutes(startTime.getMinutes() + intervalInMinuts);
            }
            addTimeTable();
        }

        function addDateTable() {
            // dateTable.forEach(() => getDates.push(false));
            let datesContainer = document.getElementById('dates_container');
            datesContainer.innerHTML = '';

            dateTable.forEach((item, i) => {
                let div = document.createElement('div');
                div.className = 'date_picker_item';

                let input = document.createElement('input');
                input.type = 'radio';
                input.setAttribute('name', 'date');
                input.id = 'date_picker_' + i;
                input.value = item.toLocaleDateString();

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

            timeTable.forEach((item, i) => {
                let div = document.createElement('div');
                div.className = 'time_picker_item';

                let input = document.createElement('input');
                input.type = 'checkbox';
                input.setAttribute('name', 'time_picker_' + i);
                input.id = 'time_picker_' + i;
                input.value = item;
                input.onclick = function() {
                    checkButtons(event);
                };

                let label = document.createElement('label');
                label.className = 'whatever';
                label.setAttribute('for', 'time_picker_' + i);
                label.innerHTML = item;

                getTimes.push(input)

                div.appendChild(input);
                div.appendChild(label);

                timesContainer.appendChild(div);
            });
        }

        function checkButtons(event) {
            setTimeout(() => {
                selectedTimes = [];
                for (let i = 0; i < getTimes.length; i++) {
                    if (getTimes.at(i).checked) {
                        selectedTimes.push(getTimes.at(i).value);
                    }
                }
                if (selectedTimes.length > 0) {
                    for (let i = 0; i < getTimes.length; i++) {
                        getTimes.at(i).disabled = true;
                    }

                    for (let i = 0; i < getTimes.length; i++) {
                        if (getTimes.at(i).checked) {
                            getTimes.at(i).disabled = false;

                            if (getTimes.at(i - 1) && i !== 0) {
                                getTimes.at(i - 1).disabled = false;
                            }

                            if (getTimes.at(i + 1) && i !== (getTimes.length - 1)) {
                                getTimes.at(i + 1).disabled = false;
                            }
                        }

                        if (i !== 0 && getTimes.at(i - 1)?.checked && getTimes.at(i + 1)
                            ?.checked) {
                            getTimes.at(i).checked = true;
                        }
                    }
                } else {
                    for (let i = 0; i < getTimes.length; i++) {
                        getTimes.at(i).disabled = false;
                    }
                }
            }, 0);
        }

        function submity() {
            console.log(getTimes);
            console.log(selectedTimes);
            console.log(selectedRooms);
            console.log(selectedMats);
            console.log({
                user: '0123456789',
                // date: this.form.getRawValue().date,
                start_time: selectedTimes[0],
                end_time: selectedTimes[selectedTimes.length - 1],
                classroom: selectedRooms,
                materials: selectedMats,
            });
        }
    </script>
@endsection
