@extends('dashboard.layouts.main')

@section('container')
    <style>
        /* Breadcrumb container */
        .breadcrumb {
            padding: 10px 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Breadcrumb items */
        .breadcrumb-item {
            display: inline-block;
            margin-right: 5px;
        }

        /* Link styling */
        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Separator */
        .breadcrumb-item::after {
            content: '>';
            margin-left: 5px;
            margin-right: 5px;
            color: #6c757d;
        }

        /* Active page */
        .breadcrumb-item.active {
            color: #6c757d;
        }

        #map {
            height: 560px;
            /* Set the desired height */
            width: 100%;
            /* Make the map container take the full width */
        }

        /* Adjust the width of each column */
        .popup-content {
            display: flex;
        }

        .popup-title {
            margin-left: 2.5;
        }

        .column {
            flex: 1;
            padding: 2px;
        }

        .small-btn {
            padding: 0.1rem 0.1rem;
            /* Adjust padding as needed */
            font-size: 0.65rem;
            /* Adjust font size as needed */
        }
    </style>

    {{-- Heading --}}
    <div class="breadcrumb mt-4 mb-0">
        <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Peta</a></div>
        <div class="breadcrumb-item active">Halaman saat ini</div>
    </div>

    {{-- /Heading --}}
    {{-- leaflet full here --}}


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3  border-bottom">

    </div>
    <div class="col-lg-12">
        <h1 class="h5">Pemetaan alat tanah pintar dan air pintar</h1>
        <h1 class="h6 fw-lighter">pengukuran terakhir dari tiap lokasi pada tiap alat tanah pintar dan air pintar</h1>
        <div id="map"></div>
    </div>
    <script>
        // const latitude = document.querySelector("#latitude");
        // const longitude = document.querySelector("#longitude");

        var map = L.map('map').setView([0.7893, 113.9213], 4);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        @foreach ($measurements as $measurement)
            var curLocation = [{{ $measurement->location->latitude }},
            {{ $measurement->location->longitude }}]; // centre point of map 
            map.attributionControl.setPrefix(false);

            var marker = new L.marker(curLocation, {
                draggable: 'false',
            });
            map.addLayer(marker);


            L.marker(curLocation)
                .bindPopup(
                    "<div class='popup-title'><strong>Data Pengukuran Terakhir Tanah Pintar 1:</strong></div>" +
                    "<div class='popup-content'>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Suhu:</strong> <br>{{ $measurement->temperature }}</div>" +
                    "<div class='my-1'><strong>pH:</strong> <br>{{ $measurement->ph }}</div>" +
                    "<div class='my-1'><strong>Kelembaban:</strong> <br>{{ $measurement->moisture }}</div>" +
                    "<div class='my-1'><strong>Konduktivitas Listrik:</strong> <br>{{ $measurement->ec }}</div>" +
                    "<a href='/dashboard/measurement/{{ $measurement->idMeasurement }}' class='btn btn-outline-info btn-sm small-btn'>Detail Pengukuran</a>" +
                    "</div>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Nitrogen:</strong> <br>{{ $measurement->nitrogen }}</div>" +
                    "<div class='my-1'><strong>Fosfor:</strong> <br>{{ $measurement->phosporus }}</div>" +
                    "<div class='my-1'><strong>Kalium:</strong> <br>{{ $measurement->potassium }}</div>" +
                    "<div class='my-1'><strong>Ketinggian:</strong> <br>{{ $measurement->altitude }}</div>" +
                    "</div>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Garis Lintang (Latitude):</strong> <br>{{ $measurement->location->latitude }}</div>" +
                    "<div class='my-1'><strong>Garis Bujur (Longitude):</strong> <br>{{ $measurement->location->longitude }}</div>" +
                    "<div class='my-1'><strong>Nama:</strong> <br>{{ $measurement->location->name }}</div>" +
                    "</div>" +
                    "</div>"
                ).addTo(map);
        @endforeach

        @foreach ($measurements2 as $measurement2)
            var curLocation2 = [{{ $measurement2->latitude }}, {{ $measurement2->longitude }}]; // centre point of map 
            map.attributionControl.setPrefix(false);

            var marker2 = new L.marker(curLocation2, {
                draggable: 'false',
            });
            map.addLayer(marker2);

            L.marker(curLocation2)
                .bindPopup(
                    "<div class='popup-title'><strong>Data Pengukuran Terakhir Tanah Pintar 2:</strong></div>" +
                    "<div class='popup-content'>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>pH:</strong> <br>{{ $measurement2->ph }}</div>" +
                    "<div class='my-1'><strong>Kelembaban:</strong> <br>{{ $measurement2->moisture }}</div>" +
                    "<div class='my-1'><strong>Nitrogen:</strong> <br>{{ $measurement2->nitrogen }}</div>" +
                    "<a href='/dashboard/measurement-2/{{ $measurement2->idMeasurement }}' class='btn btn-outline-info btn-sm small-btn'>Detail Pengukuran</a>" +                    "</div>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Fosfor:</strong> <br>{{ $measurement2->phosporus }}</div>" +
                    "<div class='my-1'><strong>Kalium:</strong> <br>{{ $measurement2->potassium }}</div>" +
                    "</div>" +
                    "</div>"
                ).addTo(map);
        @endforeach

        @foreach ($measurements3 as $measurement3)
            var curLocation3 = [{{ $measurement3->latitude }}, {{ $measurement3->longitude }}]; // centre point of map 
            map.attributionControl.setPrefix(false);

            var marker3 = new L.marker(curLocation3, {
                draggable: 'false',
            });
            map.addLayer(marker3);

            L.marker(curLocation3)
                .bindPopup(
                    "<div class='popup-title'><strong>Data Pengukuran Terakhir Air Pintar:</strong></div>" +
                    "<div class='popup-content'>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Jarak:</strong> <br>{{ $measurement3->distance }}</div>" +
                    "<div class='my-1'><strong>Laju Arus:</strong> <br>{{ $measurement3->flowRate }}</div>" +
                    "<a href='/dashboard/measurement-3/{{ $measurement3->idMeasurement }}' class='btn btn-outline-info btn-sm small-btn'>Detail Pengukuran</a>" +                    "</div>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Curah Hujan:</strong> <br>{{ $measurement3->rainFall }}</div>" +
                    "</div>" +
                    "</div>"
                ).addTo(map);
        @endforeach
    </script>
@endsection
