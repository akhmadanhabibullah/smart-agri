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
        <div id="map" style="height: 600px;"></div>
    </div>
    <script>
        var map = L.map('map').setView([0.7893, 113.9213], 4);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        @foreach ($datasmartsoil1 as $measurement)
            var curLocation = [{{ $measurement['latitude'] ?? '0' }}, {{ $measurement['longitude'] ?? '0' }}];
            L.marker(curLocation)
                .bindPopup(
                    "<div class='popup-title'><strong>Data Pengukuran Terakhir Tanah Pintar 1:</strong></div>" +
                    "<div class='popup-content'>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Suhu:</strong> <br>{{ $measurement['temperature'] ?? 'N/A' }}</div>" +
                    "<div class='my-1'><strong>pH:</strong> <br>{{ $measurement['ph'] ?? 'N/A' }}</div>" +
                    "<div class='my-1'><strong>Kelembaban:</strong> <br>{{ $measurement['moisture'] ?? 'N/A' }}</div>" +
                    "<div class='my-1'><strong>Konduktivitas Listrik:</strong> <br>{{ $measurement['conductivity'] ?? 'N/A' }}</div>" +
                    "</div>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Nitrogen:</strong> <br>{{ $measurement['nitrogen'] ?? 'N/A' }}</div>" +
                    "<div class='my-1'><strong>Fosfor:</strong> <br>{{ $measurement['fosfor'] ?? 'N/A' }}</div>" +
                    "<div class='my-1'><strong>Kalium:</strong> <br>{{ $measurement['kalium'] ?? 'N/A' }}</div>" +
                    "</div>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Garis Lintang (Latitude):</strong> <br>{{ $measurement['latitude'] ?? 'N/A' }}</div>" +
                    "<div class='my-1'><strong>Garis Bujur (Longitude):</strong> <br>{{ $measurement['longitude'] ?? 'N/A' }}</div>" +
                    "<a href='/dashboard/measurement/{{ $measurement['TS'] }}' class='btn btn-outline-info btn-sm small-btn'>Detail Pengukuran</a>" +
                    "</div>" +
                    "</div>"
                ).addTo(map);
        @endforeach

        @foreach ($datasmartsoil2 as $measurement2)
    var curLocation2 = [{{ $measurement2['latitude'] ?? '0' }}, {{ $measurement2['longitude'] ?? '0' }}];
    L.marker(curLocation2)
        .bindPopup(
            "<div class='popup-title'><strong>Data Pengukuran Terakhir Tanah Pintar 2:</strong></div>" +
            "<div class='popup-content'>" +
            "<div class='column'>" +
            "<div class='my-1'><strong>pH:</strong> <br>{{ $measurement2['ph'] ?? 'N/A' }}</div>" +
            "<div class='my-1'><strong>Kelembaban:</strong> <br>{{ $measurement2['kelembapan'] ?? 'N/A' }}</div>" +
            "<div class='my-1'><strong>Nitrogen:</strong> <br>{{ $measurement2['nitrogen'] ?? 'N/A' }}</div>" +
            "</div>" +
            "<div class='column'>" +
            "<div class='my-1'><strong>Fosfor:</strong> <br>{{ $measurement2['phosporus'] ?? 'N/A' }}</div>" +
            "<div class='my-1'><strong>Kalium:</strong> <br>{{ $measurement2['kalium'] ?? 'N/A' }}</div>" +
            "<a href='/dashboard/measurement-2/{{ $measurement2['TS'] }}' class='btn btn-outline-info btn-sm small-btn'>Detail Pengukuran</a>" +
            "</div>" +
            "</div>"
        ).addTo(map);
@endforeach


        @foreach ($datasmartirrigation as $measurement3)
            var curLocation3 = [{{ $measurement3['latitude'] ?? '0' }}, {{ $measurement3['longitude'] ?? '0' }}];
            L.marker(curLocation3)
                .bindPopup(
                    "<div class='popup-title'><strong>Data Pengukuran Terakhir Air Pintar:</strong></div>" +
                    "<div class='popup-content'>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Jarak:</strong> <br>{{ $measurement3['distance'] ?? 'N/A' }}</div>" +
                    "<div class='my-1'><strong>Laju Arus:</strong> <br>{{ $measurement3['flowRate'] ?? 'N/A' }}</div>" +
                    "</div>" +
                    "<div class='column'>" +
                    "<div class='my-1'><strong>Curah Hujan:</strong> <br>{{ $measurement3['rainFall'] ?? 'N/A' }}</div>" +
                    "<a href='/dashboard/measurement-3/{{ $measurement3['TS'] }}' class='btn btn-outline-info btn-sm small-btn'>Detail Pengukuran</a>" +
                    "</div>" +
                    "</div>"
                ).addTo(map);
        @endforeach
    </script>
@endsection
