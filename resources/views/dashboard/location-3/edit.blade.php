@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Lokasi</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/location-3/{{ $location3->idLocation }}" class="mb-3"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" value="{{ $location3->name }}" class="form-control @error('name') is-invalid @enderror"
                    name="name" id="name" required value="{{ old('name', $location3->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" value="{{ $location3->address }}"
                    class="form-control @error('address') is-invalid @enderror" name="address" id="address" required
                    value="{{ old('address', $location3->address) }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ $location3->latitude }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" required
                    value="{{ old('latitude', $location3->latitude) }}">
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Garis Bujur (Longitude)</label>
                <input type="text" value="{{ $location3->longitude }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" required
                    value="{{ old('longitude', $location3->longitude) }}">
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary ">Edit Lokasi</button>
        </form>
    </div>
@endsection
