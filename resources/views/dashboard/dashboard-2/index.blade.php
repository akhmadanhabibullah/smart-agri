@extends('dashboard.layouts.main')

@section('container')
    {{-- leaflet full here --}}

    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
        <h1 class="h2">Selamat datang di Dashboard Tanah Pintar #2, {{ auth()->user()->name }}</h1>
        <h1 class="h6 fw-lighter">Alat tanah pintar untuk menghitung lima parameter yaitu ph, kelembaban, nitrogen,
            fosfor, dan kalium yang memengaruhi proses proses pertanian</h1>
    </div>
    <div class="container-fluid py-2 px-0 border-bottom">
        <div class="flex-row">
            <div class="d-flex flex-row flex-nowrap">
                <!-- pH Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">pH</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $ph }} | Indikator: {{ $phIndicator }}
                                @if ($phIndicator === 'Bad')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement-2" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- Moisture Card -->
                <div class="col-md-4 mx-1 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kelembaban</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $moisture }} | Indikator: {{ $moistureIndicator }}
                                @if ($moistureIndicator === 'Bad')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement-2" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
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
                            <a href="/dashboard/measurement-2" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row flex-nowrap">
                <!-- Phosporus Card -->
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fosfor</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $phosporus }} | Indikator: {{ $phosporusIndicator }}
                                @if ($phosporusIndicator === 'Very Low' || $phosporusIndicator === 'Very High')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement-2" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- Potassium Card -->
                <div class="col-md-4 mx-1 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kalium</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $potassium }} | Indikator: {{ $potassiumIndicator }}
                                @if ($potassiumIndicator === 'Very Low' || $potassiumIndicator === 'Very High')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement-2" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2 py-2 px-0">
        <h1 class="h5">Grafik Data Pengukuran Tani Pintar #2</h1>
        <h1 class="h6 fw-lighter">10 data pengukuran terakhir tiap parameter</h1>
        <div class="flex-column">
            <div class="d-flex flex-row flex-nowrap">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="phChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mx-1">
                    <div class="card">
                        <canvas id="moistureChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <canvas id="nitrogenChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row flex-nowrap">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="phosporusChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mx-1">
                    <div class="card">
                        <canvas id="potassiumChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const phctx = document.getElementById('phChart');
        const moisturectx = document.getElementById('moistureChart');
        const nitrogenctx = document.getElementById('nitrogenChart');
        const phosporusctx = document.getElementById('phosporusChart');
        const potassiumctx = document.getElementById('potassiumChart');

        const labels = {!! json_encode(
            $measurements2->pluck('created_at')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d-m H:i:s');
            }),
        ) !!};

        const phData = {!! json_encode($measurements2->pluck('ph')) !!};
        const moistureData = {!! json_encode($measurements2->pluck('moisture')) !!};
        const nitrogenData = {!! json_encode($measurements2->pluck('nitrogen')) !!};
        const phosphorusData = {!! json_encode($measurements2->pluck('phosporus')) !!};
        const potassiumData = {!! json_encode($measurements2->pluck('potassium')) !!};

        const latestData = (data, limit) => {
            if (data.length > limit) {
                return data.slice(-limit);
            }
            return data;
        };

        const latestLabels = latestData(labels, 10);

        const ph = {
            label: 'pH',
            data: latestData(phData, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 206, 86, 1)', // Different color for pH
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            fill: true,
        };

        const moisture = {
            label: 'Kelembaban',
            data: latestData(moistureData, 10),
            borderWidth: 1,
            borderColor: 'rgba(75, 192, 192, 1)', // Different color for humidity
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true,
        };

        const nitrogen = {
            label: 'Nitrogen',
            data: latestData(nitrogenData, 10),
            borderWidth: 1,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: true,
        };

        const phosporus = {
            label: 'Fosfor',
            data: latestData(phosphorusData, 10),
            borderWidth: 1,
            borderColor: 'rgba(153, 102, 255, 1)', // Different color for phosphorus
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            fill: true,
        };

        const potassium = {
            label: 'Kalium',
            data: latestData(potassiumData, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 159, 64, 1)', // Different color for potassium
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            fill: true,
        };


        new Chart(phctx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [ph],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        new Chart(moisturectx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [moisture],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        new Chart(nitrogenctx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [nitrogen],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        new Chart(phosporusctx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [phosporus],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        new Chart(potassiumctx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [potassium],
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
