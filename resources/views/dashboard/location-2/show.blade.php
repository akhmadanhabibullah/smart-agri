@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Lokasi</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/location-2/{{ $location2->idLocation }}" class="mb-3"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" value="{{ $location2->name }}"
                    class="form-control @error('name') is-invalid @enderror" name="name" id="name" required disabled
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" value="{{ $location2->address }}"
                    class="form-control @error('address') is-invalid @enderror" address="address" id="address" required
                    disabled value="{{ old('address') }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ $location2->latitude }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" required
                    disabled value="{{ old('latitude') }}">
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Garis Bujur (Longitude)</label>
                <input type="text" value="{{ $location2->longitude }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" required
                    disabled value="{{ old('longitude') }}">
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <label for="map" class="form-label">Lihat Peta</label>
            <div id="map"></div>

            <a href="/dashboard/location-2" class="btn btn-primary mt-3"><span data-feather="arrow-left"></span>Kembali ke data lokasi</a>
        </form>
    </div>

    <script>
        const latitude = document.querySelector("#latitude");
        const longitude = document.querySelector("#longitude");

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
                "<div class='my-1'><strong>Name:</strong> <br>{{ $location2->name }}</div>" +
                "<div class='my-1'><strong>Latitude:</strong> <br>{{ $location2->latitude }}</div>" +
                "<div class='my-1'><strong>Latitude:</strong> <br>{{ $location2->longitude }}</div>"
            ).addTo(map);
    </script>
@endsection
