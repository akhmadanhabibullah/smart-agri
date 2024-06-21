@extends('dashboard.layouts.main')

@section('container')
    {{-- leaflet full here --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
        <h1 class="h2">Selamat datang, Admin</h1>
    </div>

    <div class="container-fluid py-2 px-0 mb-3 border-bottom">
        <div class="flex-row">
            <div class="d-flex flex-row flex-nowrap">
                <!-- #1 Dashboard Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dashboard #1 Tanah Pintar</h5>
                            <p class="card-text mb-2 text-muted text-left">Alat tanah pintar untuk menghitung tujuh parameter
                                yang memengaruhi proses proses pertanian
                            </p>
                            {{-- <p class="card-text">Total Locations: {{ $locationCount }} | Conditions: Good</p> --}}
                            <a href="/dashboard/dashboard-1" class="btn btn-primary">Lihat Dashboard</a>
                        </div>
                    </div>
                </div>

                <!-- #2 Dashboard Card -->
                <div class="col-md-4 mx-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dashboard #2 Tanah Pintar</h5>
                            <p class="card-text mb-2 text-muted text-left">Alat tanah pintar untuk menghitung lima parameter
                                yang memengaruhi proses proses pertanian</p>
                            {{-- <p class="card-text">Total Locations: {{ $locationCount }} | Conditions: Good</p> --}}
                            <a href="/dashboard/dashboard-2" class="btn btn-primary">Lihat Dashboard</a>
                        </div>
                    </div>
                </div>

                <!-- #3 Dashboard Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dashboard Air Pintar</h5>
                            <p class="card-text mb-2 text-muted text-left">
                                Alat air pintar untuk menghitung tiga parameter yang memengaruhi proses irigasi air di pertanian
                                </p>
                            {{-- <p class="card-text">Total Locations: {{ $locationCount }} | Conditions: Good</p> --}}
                            <a href="/dashboard/dashboard-3" class="btn btn-primary">Lihat Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <label for="location">Select Location:</label>
    <select wire:model="selectedLocation" id="location" name="location" wire:change="loadMeasurements">
        @foreach ($locations as $location)
            <option value="{{ $location->idLocation }}">{{ $location->address }}</option>
        @endforeach
    </select> --}}

    <div class="border-bottom">
        <h1 class="h5">Data Pengukuran Terbaru Tani Pintar #1</h1>
        <h1 class="h6 fw-lighter">10 data pengukuran terakhir</h1>
        <canvas id="firstChart" style="width: 100px; height: 33px;" class="mb-3"></canvas>
    </div>

    <div class="border-bottom mt-3">
        <h1 class="h5">Data Pengukuran Terbaru Tanah Pintar #2</h1>
        <h1 class="h6 fw-lighter">10 data pengukuran terakhir</h1>
        <canvas id="secondChart" style="width: 100px; height: 33px;" class="mb-3"></canvas>
    </div>

    <div class="border-bottom mt-3">
        <h1 class="h5">Data Pengukuran Terbaru Air Pintar</h1>
        <h1 class="h6 fw-lighter">10 data pengukuran terakhir</h1>
        <canvas id="thirdChart" style="width: 100px; height: 33px;" class="mb-3"></canvas>
    </div>

 

<script>
    const ctx = document.getElementById('firstChart');
    const ctx2 = document.getElementById('secondChart');
    const ctx3 = document.getElementById('thirdChart');

    const data1 = {!! json_encode($datasmartsoil1 ?? []) !!};
    const data2 = {!! json_encode($datasmartsoil2 ?? []) !!};
    const data3 = {!! json_encode($datasmartirrigation ?? []) !!};

    const formatTimestamp1 = (timestamp1) => {
        const date1 = new Date(timestamp1);
        return `${date1.getDate()}-${date1.getMonth() + 1} ${date1.getHours()}:${date1.getMinutes()}:${date1.getSeconds()}`;
    };
    const formatTimestamp2 = (timestamp2) => {
        const date2 = new Date(timestamp2);
        return `${date2.getDate()}-${date2.getMonth() + 1} ${date2.getHours()}:${date2.getMinutes()}:${date2.getSeconds()}`;
    };
    const formatTimestamp3 = (timestamp3) => {
        const date3 = new Date(timestamp3);
        return `${date3.getDate()}-${date3.getMonth() + 1} ${date3.getHours()}:${date3.getMinutes()}:${date3.getSeconds()}`;
    };

    const latestData1 = data1.slice(-10);
    const labels1 = latestData1.map(item => formatTimestamp1(item.TS));
    const latestData2 = data2.slice(-10);
    const labels2 = latestData2.map(item => formatTimestamp2(item.TS));
    const latestData3 = data3.slice(-10);
    const labels3 = latestData3.map(item => formatTimestamp3(item.TS));

    const temperatureData1 = latestData1.map(item => item.temperature);
    const phData1 = latestData1.map(item => item.ph);
    const moistureData1 = latestData1.map(item => item.moisture);
    const nitrogenData1 = latestData1.map(item => item.nitrogen);
    const phosporusData1 = latestData1.map(item => item.fosfor);
    const potassiumData1 = latestData1.map(item => item.kalium);
    const ecData1 = latestData1.map(item => item.conductivity);

    const phData2 = latestData2.map(item => item.ph);
    const moistureData2 = latestData2.map(item => item.kelembapan);
    const nitrogenData2 = latestData2.map(item => item.nitrogen);
    const phosporusData2 = latestData2.map(item => item.phosporus);
    const potassiumData2 = latestData2.map(item => item.kalium);

    const distanceData = latestData3.map(item => item.jarak);
    const flowRateData = latestData3.map(item => item['flow rate']);
    const rainFallData = latestData3.map(item => item['curah hujan']);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels1,
            datasets: [
                {
                    label: 'Suhu',
                    data: temperatureData1,
                    borderWidth: 1,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false,
                },
                {
                    label: 'pH',
                    data: phData1,
                    borderWidth: 1,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    fill: false,
                },
                {
                    label: 'Kelembaban',
                    data: moistureData1,
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                },
                {
                    label: 'Nitrogen',
                    data: nitrogenData1,
                    borderWidth: 1,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                },
                {
                    label: 'Fosfor',
                    data: phosporusData1,
                    borderWidth: 1,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    fill: false,
                },
                {
                    label: 'Kalium',
                    data: potassiumData1,
                    borderWidth: 1,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    fill: false,
                },
                {
                    label: 'Konduktivitas Listrik',
                    data: ecData1,
                    borderWidth: 1,
                    borderColor: 'rgba(128, 128, 128, 1)',
                    backgroundColor: 'rgba(128, 128, 128, 0.2)',
                    fill: false,
                }
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels2,
            datasets: [
                {
                    label: 'pH',
                    data: phData2,
                    borderWidth: 1,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    fill: false,
                },
                {
                    label: 'Kelembaban',
                    data: moistureData2,
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                },
                {
                    label: 'Nitrogen',
                    data: nitrogenData2,
                    borderWidth: 1,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                },
                {
                    label: 'Fosfor',
                    data: phosporusData2,
                    borderWidth: 1,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    fill: false,
                },
                {
                    label: 'Kalium',
                    data: potassiumData2,
                    borderWidth: 1,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    fill: false,
                }
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    new Chart(ctx3, {
        type: 'line',
        data: {
            labels: labels3,
            datasets: [
                {
                    label: 'Jarak',
                    data: distanceData,
                    borderWidth: 1,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    fill: false,
                },
                {
                    label: 'Laju Arus',
                    data: flowRateData,
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: false,
                },
                {
                    label: 'Curah Hujan',
                    data: rainFallData,
                    borderWidth: 1,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                }
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

</script>
@endsection
