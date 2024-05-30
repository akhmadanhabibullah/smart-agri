@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengukuran</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/measurement-3/{{ $measurement3->idMeasurement }}" class="mb-3"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="distance" class="form-label">Jarak</label>
                <input type="text" value="{{ $measurement3->distance }}"
                    class="form-control @error('distance') is-invalid @enderror" name="distance" id="distance"
                    disabled value="{{ old('distance') }}">
                @error('distance')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="flowRate" class="form-label">Laju Arus</label>
                <input type="text" value="{{ $measurement3->flowRate }}" class="form-control @error('flowRate') is-invalid @enderror"
                    name="flowRate" id="flowRate" disabled value="{{ old('flowRate') }}">
                @error('flowRate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="rainFall" class="form-label">Curah Hujan</label>
                <input type="text" value="{{ $measurement3->rainFall }}"
                    class="form-control @error('rainFall') is-invalid @enderror" name="rainFall" id="rainFall" disabled
                    value="{{ old('rainFall') }}">
                @error('rainFall')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="idLocation" class="form-label">ID Lokasi</label>
                <input type="text" value="{{ $measurement3->idLocation }}"
                    class="form-control @error('idLocation') is-invalid @enderror" name="idLocation" id="idLocation"
                    disabled value="{{ old('idLocation') }}">
                @error('idLocation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ $location3->latitude }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" disabled
                    value="{{ old('latitude') }}">
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Garis Bujur (Longitude)</label>
                <input type="text" value="{{ $location3->longitude }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" disabled
                    value="{{ old('longitude') }}">
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div id="map"></div>

            <a href="/dashboard/measurement-3" class="btn btn-primary mt-3"><span data-feather="arrow-left"></span>Kembali ke data pengukuran</a>
        </form>
    </div>

    <!-- Your JavaScript code for map display -->
    <script>
        var map = L.map('map').setView([{{ $location3->latitude }}, {{ $location3->longitude }}], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([{{ $location3->latitude }}, {{ $location3->longitude }}]).addTo(map);
        marker.bindPopup("Location: {{ $location3->name }}");
    </script>

@endsection
