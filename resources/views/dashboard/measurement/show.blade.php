@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengukuran</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/measurement/{{ $measurement->idMeasurement }}" class="mb-3"
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
                <label for="phosporus" class="form-label">Fosfor</label>
                <input type="text" value="{{ $measurement->phosporus }}"
                    class="form-control @error('phosporus') is-invalid @enderror" name="phosporus" id="phosporus" disabled
                    value="{{ old('phosporus') }}">
                @error('phosporus')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="potassium" class="form-label">Kalium</label>
                <input type="text" value="{{ $measurement->potassium }}"
                    class="form-control @error('potassium') is-invalid @enderror" name="potassium" id="potassium" disabled
                    value="{{ old('potassium') }}">
                @error('potassium')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ec" class="form-label">Konduktivitas Listrik</label>
                <input type="text" value="{{ $measurement->ec }}" class="form-control @error('ec') is-invalid @enderror"
                    name="ec" id="ec" disabled value="{{ old('ec') }}">
                @error('ec')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
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
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ $measurement->location->latitude }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" disabled>
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Garis Bujur (Longitude)</label>
                <input type="text" value="{{ $measurement->location->longitude }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude"
                    disabled>
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="altitude" class="form-label">Ketinggian (Altitude)</label>
                <input type="text" value="{{ $measurement->location->altitude }}"
                    class="form-control @error('altitude') is-invalid @enderror" name="altitude" id="altitude"
                    disabled>
                @error('altitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <label for="map" class="form-label">Lihat Peta</label>
            <div id="map"></div>

            <a href="/dashboard/measurement" class="btn btn-primary mt-3"><span data-feather="arrow-left"></span>Kembali ke data pengukuran</a>
        </form>
    </div>

    <script>
        const latitude = document.querySelector("#latitude");
        const longitude = document.querySelector("#longitude");
        const altitude = document.querySelector("#altitude");

        var map = L.map('map').setView([latitude.value, longitude.value, altitude.value], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var curLocation = [latitude.value, longitude.value, altitude.value];
        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'false',
        });
        map.addLayer(marker);

        L.marker([latitude.value, longitude.value, altitude.value])
            .bindPopup(
                "<div class='my-1'><strong>Name:</strong> <br>{{ $location->name }}</div>" +
                "<div class='my-1'><strong>Latitude:</strong> <br>{{ $location->latitude }}</div>" +
                "<div class='my-1'><strong>Latitude:</strong> <br>{{ $location->latitude }}</div>" +
                "<div class='my-1'><strong>Altitude:</strong> <br>{{ $location->altitude }}</div>"
            ).addTo(map);
    </script>
@endsection
