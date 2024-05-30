@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Pengukuran</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/measurement-2" class="mb-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="ph" class="form-label">pH</label>
                <input type="text" class="form-control @error('ph') is-invalid @enderror" name="ph" id="ph"
                    required value="{{ old('ph') }}">
                @error('ph')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="moisture" class="form-label">Kelembaban</label>
                <input type="text" class="form-control @error('moisture') is-invalid @enderror" name="moisture"
                    id="moisture" required value="{{ old('moisture') }}">
                @error('moisture')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nitrogen" class="form-label">Nitrogen</label>
                <input type="text" class="form-control @error('nitrogen') is-invalid @enderror" name="nitrogen"
                    id="nitrogen" required value="{{ old('nitrogen') }}">
                @error('nitrogen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phosporus" class="form-label">Fosfor</label>
                <input type="text" class="form-control @error('phosporus') is-invalid @enderror" name="phosporus"
                    id="phosporus" required value="{{ old('phosporus') }}">
                @error('phosporus')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="potassium" class="form-label">Kalium</label>
                <input type="text" class="form-control @error('potassium') is-invalid @enderror" name="potassium"
                    id="potassium" required value="{{ old('potassium') }}">
                @error('potassium')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">ID Lokasi</label>
                <select class="form-select" name="idLocation" id="idLocation">
                    @foreach ($locations2 as $location2)
                        @if (old('idLocation') == $location2->idLocation)
                            <option value="{{ $location2->idLocation }}" selected>{{ $location2->idLocation }}</option>
                        @else
                            <option value="{{ $location2->idLocation }}">{{ $location2->idLocation }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ old('latitude', $location2->latitude) }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" required>
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Garis Bujur (Longitude)</label>
                <input type="text" value="{{ old('longitude', $location2->longitude) }}"
                    class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" required>
                @error('longitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary ">Tambah Pengukuran</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
  <script>
    $(document).ready(function() {
    // Attach change event to the dropdown
    $('#idLocation').on('change', function() {
        // Get the selected ID Location
        var selectedIdLocation = $(this).val();

        // Make an AJAX request to get Latitude and Longitude based on the selected ID Location
        $.ajax({
            url: '/dashboard/getLocationDetails/' + selectedIdLocation,
            type: 'GET',
            success: function(data) {
                // Update the Latitude and Longitude input fields with the retrieved values
                $('#latitude').val(data.latitude);
                $('#longitude').val(data.longitude);
            },
            error: function() {
                // Handle error if needed
            }
        });
    });
});

  </script>
@endsection
