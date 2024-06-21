@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengukuran</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/measurement/{{ $measurement->TS }}" class="mb-3"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="temperature" class="form-label">Suhu</label>
                <input type="text" value="{{ $measurement->temperature }}"
                    class="form-control @error('temperature') is-invalid @enderror" name="temperature" id="temperature"
                    disabled value="{{ old('temperature') }}">
                @error('temperature')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ph" class="form-label">pH</label>
                <input type="text" value="{{ $measurement->ph }}" class="form-control @error('ph') is-invalid @enderror"
                    name="ph" id="ph" disabled value="{{ old('ph') }}">
                @error('ph')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="moisture" class="form-label">Kelembaban</label>
                <input type="text" value="{{ $measurement->moisture }}"
                    class="form-control @error('moisture') is-invalid @enderror" name="moisture" id="moisture" disabled
                    value="{{ old('moisture') }}">
                @error('moisture')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nitrogen" class="form-label">Nitrogen</label>
                <input type="text" value="{{ $measurement->nitrogen }}"
                    class="form-control @error('nitrogen') is-invalid @enderror" name="nitrogen" id="nitrogen" disabled
                    value="{{ old('nitrogen') }}">
                @error('nitrogen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fosfor" class="form-label">Fosfor</label>
                <input type="text" value="{{ $measurement->fosfor }}"
                    class="form-control @error('fosfor') is-invalid @enderror" name="fosfor" id="fosfor" disabled
                    value="{{ old('fosfor') }}">
                @error('fosfor')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kalium" class="form-label">Kalium</label>
                <input type="text" value="{{ $measurement->kalium }}"
                    class="form-control @error('kalium') is-invalid @enderror" name="kalium" id="kalium" disabled
                    value="{{ old('kalium') }}">
                @error('kalium')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="conductivity" class="form-label">Konduktivitas Listrik</label>
                <input type="text" value="{{ $measurement->conductivity }}" class="form-control @error('conductivity') is-invalid @enderror"
                    name="conductivity" id="conductivity" disabled value="{{ old('conductivity') }}">
                @error('conductivity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <label for="location" class="form-label">ID Lokasi</label>
                <select class="form-select" name="idLocation" id="idLocation" disabled>
                    @foreach ($locations as $location)
                        @if ($measurement->idLocation == $location->idLocation)
                            <option value="{{ $location->idLocation }}" selected>{{ $location->idLocation }}</option>
                        @else
                            <option value="{{ $location->idLocation }}">{{ $location->idLocation }}</option>
                        @endif
                    @endforeach
                </select>
            </div> --}}

            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ $measurement->latitude }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" disabled>
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Garis Bujur (Longitude)</label>
                <input type="text" value="{{ $measurement->longitude }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude"
                    disabled>
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="altitude" class="form-label">Ketinggian (Altitude)</label>
                <input type="text" value="{{ $measurement->location->altitude }}"
                    class="form-control @error('altitude') is-invalid @enderror" name="altitude" id="altitude"
                    disabled>
                @error('altitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}

            <label for="map" class="form-label">Lihat Peta</label>
            <div id="map"></div>

            <a href="/dashboard/measurement" class="btn btn-primary mt-3"><span data-feather="arrow-left"></span>Kembali ke data pengukuran</a>
        </form>
    </div>

    <script>
        const latitude = document.querySelector("#latitude");
        const longitude = document.querySelector("#longitude");
        // const altitude = document.querySelector("#altitude");

        var map = L.map('map').setView([latitude.value, longitude.value], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var curLocation = [latitude.value, longitude.value];
        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'false',
        });
        map.addLayer(marker);

        L.marker([latitude.value, longitude.value])
            .bindPopup(
                "<div class='my-1'><strong>Longitude:</strong> <br>{{ $measurement->longitude }}</div>" +
                "<div class='my-1'><strong>Latitude:</strong> <br>{{ $measurement->latitude }}</div>" 
            ).addTo(map);
    </script>
@endsection
