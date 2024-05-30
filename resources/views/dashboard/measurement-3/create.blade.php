@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Pengukuran</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/measurement-3" class="mb-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="distance" class="form-label">Jarak</label>
                <input type="text" class="form-control @error('distance') is-invalid @enderror" name="distance"
                    id="distance" required autofocus value="{{ old('distance') }}">
                @error('distance')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="flowRate" class="form-label">Laju Arus</label>
                <input type="text" class="form-control @error('flowRate') is-invalid @enderror" name="flowRate" id="flowRate"
                    required value="{{ old('flowRate') }}">
                @error('flowRate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="rainFall" class="form-label">Curah Hujan</label>
                <input type="text" class="form-control @error('rainFall') is-invalid @enderror" name="rainFall"
                    id="rainFall" required value="{{ old('rainFall') }}">
                @error('rainFall')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">ID Lokasi</label>
                <select class="form-select" name="idLocation" id="idLocation">
                    @foreach ($locations3 as $location3)
                        @if (old('idLocation') == $location3->idLocation)
                            <option value="{{ $location3->idLocation }}" selected>{{ $location3->idLocation }}</option>
                        @else
                            <option value="{{ $location3->idLocation }}">{{ $location3->idLocation }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Garis Lintang (Latitude)</label>
                <input type="text" value="{{ old('latitude', $location3->latitude) }}"
                    class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" required>
                @error('latitude')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Garis Bujur (Longitude)</label>
                <input type="text" value="{{ old('longitude', $location3->longitude) }}"
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
