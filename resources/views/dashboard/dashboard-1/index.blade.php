@extends('dashboard.layouts.main')

@section('container')
    {{-- leaflet full here --}}

    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
        <h1 class="h2">Selamat datang di Dashboard Tanah Pintar #1, Admin</h1>
        <h1 class="h6 fw-lighter">
            Alat tanah pintar untuk menghitung tujuh parameter yaitu suhu, ph, kelembaban, nitrogen, fosfor, kalium, dan konduktivitas listrik yang memengaruhi proses proses pertanian
            </h1>
    </div>

    <div class="container-fluid py-2 px-0 border-bottom">
        <div class="flex-row">
            <div class="d-flex flex-row flex-nowrap">
                <!-- Temperature Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Suhu</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $temperature }} | Indikator: {{ $tempIndicator }}
                                @if ($tempIndicator === 'Bad')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- pH Card -->
                <div class="col-md-4 mx-1 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">pH</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $ph }} | Indikator: {{ $phIndicator }}
                                @if ($phIndicator === 'Bad')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- Moisture Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kelembaban</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $moisture }} | Indikator: {{ $moistureIndicator }}
                                @if ($moistureIndicator === 'Bad')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row flex-nowrap">
                <!-- Nitrogen Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nitrogen</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $nitrogen }} | Indikator: {{ $nitrogenIndicator }}
                                @if ($nitrogenIndicator === 'Very Low' || $nitrogenIndicator === 'Very High')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- Phosporus Card -->
                <div class="col-md-4 mb-1 mx-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fosfor</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $phosporus }} | Indikator: {{ $phosporusIndicator }}
                                @if ($phosporusIndicator === 'Very Low' || $phosporusIndicator === 'Very High')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- Potassium Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kalium</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $potassium }} | Indikator: {{ $potassiumIndicator }}
                                @if ($potassiumIndicator === 'Very Low' || $potassiumIndicator === 'Very High')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Electrical Conductivity Card -->
            <div class="d-flex flex-row flex-nowrap">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Konduktivitas Listrik</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $ec }} | Indikator: {{ $ecIndicator }}
                                @if ($ecIndicator === 'Bad')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="accordion border-bottom py-3" id="accordionExample">
        <h1 class="h5">Rekomendasi</h1>
        <h1 class="h6 fw-lighter">
            rekomendasi secara keseluruhan berdasarkan pengukuran terakhir dari semua parameter</h1>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Rekomendasi #1
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Pupuk yang paling sesuai berdasarkan kondisi tanah saat ini adalah <strong>xxx</strong>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Rekomendasi #2
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Tanaman yang paling sesuai berdasarkan kondisi tanah saat ini adalah <strong>yyy</strong>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container-fluid mt-2 py-2 px-0">
        <h1 class="h5">Grafik Data Pengukuran Tani Pintar #1</h1>
        <h1 class="h6 fw-lighter">10 data pengukuran terakhir tiap parameter</h1>
        <div class="flex-column">
            <div class="d-flex flex-row flex-nowrap">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="tempChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mx-1">
                    <div class="card">
                        <canvas id="phChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="moistureChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row flex-nowrap">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="nitrogenChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mx-1">
                    <div class="card">
                        <canvas id="phosporusChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="potassiumChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row flex-nowrap">
                <div class="col-md-4">
                    <div class="card">
                        <canvas id="ecChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const tempctx = document.getElementById('tempChart');
        const phctx = document.getElementById('phChart');
        const moisturectx = document.getElementById('moistureChart');
        const nitrogenctx = document.getElementById('nitrogenChart');
        const phosporusctx = document.getElementById('phosporusChart');
        const potassiumctx = document.getElementById('potassiumChart');
        const ecctx = document.getElementById('ecChart');

        // Assuming the data is already sorted in ascending order by timestamp
        const data = {!! json_encode($datasmartsoil1 ?? []) !!};

        // Function to format timestamps
        const formatTimestamp = (timestamp) => {
            const date = new Date(timestamp);
            return `${date.getDate()}-${date.getMonth() + 1} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
        };

        // Extract latest 10 data points and format timestamps
        const latestData = data.slice(-10);
        const labels = latestData.map(item => formatTimestamp(item.TS));

        // Extract values for each parameter
        const temperatureData = latestData.map(item => item.temperature);
        const phData = latestData.map(item => item.ph);
        const moistureData = latestData.map(item => item.moisture);
        const nitrogenData = latestData.map(item => item.nitrogen);
        const phosporusData = latestData.map(item => item.fosfor);
        const potassiumData = latestData.map(item => item.kalium);
        const ecData = latestData.map(item => item.conductivity);

        const createChart = (ctx, label, data, borderColor, backgroundColor) => {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderWidth: 1,
                        borderColor: borderColor,
                        backgroundColor: backgroundColor,
                        fill: true,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        };

        // Create charts
        createChart(tempctx, 'Suhu', temperatureData, 'rgba(255, 99, 132, 1)', 'rgba(255, 99, 132, 0.2)');
        createChart(phctx, 'pH', phData, 'rgba(255, 206, 86, 1)', 'rgba(255, 206, 86, 0.2)');
        createChart(moisturectx, 'Kelembaban', moistureData, 'rgba(75, 192, 192, 1)', 'rgba(75, 192, 192, 0.2)');
        createChart(nitrogenctx, 'Nitrogen', nitrogenData, 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 0.2)');
        createChart(phosporusctx, 'Fosfor', phosporusData, 'rgba(153, 102, 255, 1)', 'rgba(153, 102, 255, 0.2)');
        createChart(potassiumctx, 'Kalium', potassiumData, 'rgba(255, 159, 64, 1)', 'rgba(255, 159, 64, 0.2)');
        createChart(ecctx, 'Konduktivitas Listrik', ecData, 'rgba(128, 123, 128, 1)', 'rgba(128, 128, 128, 0.2)');
    </script>


    {{-- <label for="location">Select Location:</label>
    <select wire:model="selectedLocation" id="location" name="location" wire:change="loadMeasurements">
        @foreach ($locations as $location)
            <option value="{{ $location->idLocation }}">{{ $location->address }}</option>
        @endforeach
    </select> --}}

    {{-- <div>
        <canvas id="myChart" style="width: 100px; height: 33px;"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('myChart');
        const labels = {!! json_encode(
            $measurements->pluck('created_at')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d H:i:s');
            }),
        ) !!};

        const temperature = {
            label: 'Temperature',
            data: {!! json_encode($measurements->pluck('temperature')) !!},
            borderWidth: 1,
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            fill: false,
        };

        const ph = {
            label: 'pH',
            data: {!! json_encode($measurements->pluck('ph')) !!},
            borderWidth: 1,
            borderColor: 'rgba(255, 206, 86, 1)', // Different color for pH
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            fill: false,
        };

        const humidity = {
            label: 'Humidity',
            data: {!! json_encode($measurements->pluck('humidity')) !!},
            borderWidth: 1,
            borderColor: 'rgba(75, 192, 192, 1)', // Different color for humidity
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: false,
        };

        const nitrogen = {
            label: 'Nitrogen',
            data: {!! json_encode($measurements->pluck('nitrogen')) !!},
            borderWidth: 1,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: false,
        };

        const phosporus = {
            label: 'Phosporus',
            data: {!! json_encode($measurements->pluck('phosporus')) !!},
            borderWidth: 1,
            borderColor: 'rgba(153, 102, 255, 1)', // Different color for phosphorus
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            fill: false,
        };

        const potassium = {
            label: 'Potassium',
            data: {!! json_encode($measurements->pluck('potassium')) !!},
            borderWidth: 1,
            borderColor: 'rgba(255, 159, 64, 1)', // Different color for potassium
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            fill: false,
        };

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [temperature, ph, humidity, nitrogen, phosporus, potassium],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script> --}}
@endsection
