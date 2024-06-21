@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengukuran</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/measurement-2/{{ $measurement2->TS }}" class="mb-3"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="ph" class="form-label">pH</label>
                <input type="text" value="{{ $measurement2->ph }}" class="form-control @error('ph') is-invalid @enderror"
                    name="ph" id="ph" disabled value="{{ old('ph') }}">
                @error('ph')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="moisture" class="form-label">Kelembaban</label>
                <input type="text" value="{{ $measurement2->kelembapan }}"
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
                <input type="text" value="{{ $measurement2->nitrogen }}"
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
                <input type="text" value="{{ $measurement2->phosporus }}"
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
                <input type="text" value="{{ $measurement2->kalium }}"
                    class="form-control @error('potassium') is-invalid @enderror" name="potassium" id="potassium" disabled
                    value="{{ old('potassium') }}">
                @error('potassium')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="idLocation" class="form-label">ID Lokasi</label>
                <input type="text" value="{{ $measurement2->idLocation }}"
                    class="form-control @error('idLocation') is-invalid @enderror" name="idLocation" id="idLocation"
                    disabled value="{{ old('idLocation') }}">
                @error('idLocation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ $measurement2->latitude }}"
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
                <input type="text" value="{{ $measurement2->longitude }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" disabled
                    value="{{ old('longitude') }}">
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div id="map"></div>

            <a href="/dashboard/measurement-2" class="btn btn-primary mt-3"><span data-feather="arrow-left"></span>Kembali ke data pengukuran</a>
        </form>
    </div>

    <!-- Your JavaScript code for map display -->
    <script>
        var map = L.map('map').setView([{{ $measurement2->latitude }}, {{ $measurement2->longitude }}], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([{{ $measurement2->latitude }}, {{ $measurement2->longitude }}]).addTo(map);
        marker.bindPopup("Longitude: {{ $measurement2->longitude }}, Latidude: {{ $measurement2->latitude }},");
    </script>
@endsection
