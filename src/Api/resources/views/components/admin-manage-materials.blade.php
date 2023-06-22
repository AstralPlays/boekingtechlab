@vite(['resources/scss/admin-manage-materials.scss', 'resources/js/swiper.js'])

@extends('layouts.default')

@section('content')
    <x-side-bar />
    <div class="container">
        <div class="wrapper">
            <div class="addMaterial">
                <span>Nieuwe lokaal aanmaken</span>
                <form onsubmit="uploadMaterial(event)">
                    <div class="input">
                        <label for="materialName">Naam</label>
                        <input type="text" name="materialName" id="materialName" required>
                    </div>
                    <div class="input">
                        <label for="quantity">Hoeveelheid</label>
                        <input type="number" name="quantity" id="quantity" required>
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

            <div class="materials">
                <div class="swiper">
                    <div class="swiper-wrapper" id="materials-wrapper">
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
        function uploadMaterial(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('materialName', document.getElementById('materialName').value);
            formData.append('quantity', document.getElementById('quantity').value);
            formData.append('image', document.getElementById('image').files[0]);

            var settings = {
                method: "POST",
                timeout: 0,
                body: formData
            };

            fetch("{{ env('APP_URL') }}/api/admin/addMaterial", settings)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    if (data == 'success') {
                        window.location.reload();
                    } else {
                        alert(data);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }

        function addMaterials(materials) {
            document.getElementById('materials-wrapper').innerHTML = '';
            materials.forEach((item, i) => {
                document.getElementById('materials-wrapper').innerHTML += `
					<div class="swiper-slide" id="material${item.id}">
                        <div class="swiper_item">
                            <span>${item.name}</span>
                            <img src="{{ env('APP_URL') }}/images/materials/${item.image}" alt="">
                            <div class="controllers">
								<span>Hoeveelheid: ${item.quantity}</span>
								<button type="button" onclick="removeMaterial(${item.id})">Verwijderen</button>
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

        function removeMaterial(id) {
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

            fetch("{{ env('APP_URL') }}/api/admin/removeMaterial", settings)
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
                        document.getElementById('material' + id).remove();
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

        fetch("{{ env('APP_URL') }}/api/material/getMaterials", settings)
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
                addMaterials(data);
            })
            .catch(error => {
                console.log('error', error);
            });
    </script>
@endsection
