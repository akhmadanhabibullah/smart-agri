@extends('dashboard.layouts.main')

@section('container')
    {{-- leaflet full here --}}

    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
        <h1 class="h2">Selamat datang di Dashboard Air Pintar, {{ auth()->user()->name }}</h1>
        <h1 class="h6 fw-lighter">
            Alat air pintar untuk menghitung tiga parameter, yaitu jarak, laju arus, dan curah hujan yang mempengaruhi
            proses pengairan
        </h1>
    </div>
    <div class="container-fluid py-2 px-0 border-bottom">
        <div class="flex-row">
            <div class="d-flex flex-row flex-nowrap">
                <!-- Distance Card -->
                <div class="col-md-4 mb-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jarak</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $distance }} | Indicator: {{ $distanceIndicator }}
                                @if ($distanceIndicator === 'Warning')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement-3" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- Flow Rate Card -->
                <div class="col-md-4 mx-1 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laju Arus</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $flowRate }} | Indikator: {{ $flowRateIndicator }}
                                @if ($flowRateIndicator === 'Warning')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement-3" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
                <!-- Rain Fall Card -->
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Curah Hujan</h5>
                            <p class="card-text">Pengukuran terakhir: {{ $rainFall }} | Indikator: {{ $rainFallIndicator }}
                                @if ($rainFallIndicator === 'Warning')
                                    <span data-feather="alert-triangle" class="text-danger"></span>
                                @endif
                            </p>
                            <a href="/dashboard/measurement-3" class="btn btn-primary">Lihat Pengukuran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion border-bottom py-3" id="accordionExample">
        <h1 class="h5">Rekomendasi</h1>
        <h1 class="h6 fw-lighter">rekomendasi secara keseluruhan berdasarkan pengukuran terakhir dari semua parameter</h1>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Lihat Rekomendasi
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Berdasarkan data pengukuran secara keseluruhan, kondisi saat ini adalah <strong>{{ $recommendationBox }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2 py-2 px-0">
        <h1 class="h5">Grafik Data Pengukuran Air Pintar</h1>
        <h1 class="h6 fw-lighter">10 data pengukuran terakhir tiap parameter</h1>
        <div class="flex-column">
            <div class="d-flex flex-row flex-nowrap">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="distanceChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mx-1">
                    <div class="card">
                        <canvas id="flowRateChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <canvas id="rainFallChart" style="width: 80px; height: 100px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const distancectx = document.getElementById('distanceChart');
        const flowratectx = document.getElementById('flowRateChart');
        const rainfallctx = document.getElementById('rainFallChart');

        const labels = {!! json_encode(
            $measurements->pluck('created_at')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d-m H:i:s');
            }),
        ) !!};

        const distanceData = {!! json_encode($measurements->pluck('distance')) !!};
        const flowRateData = {!! json_encode($measurements->pluck('flowRate')) !!};
        const rainFallData = {!! json_encode($measurements->pluck('rainFall')) !!};

        const latestData = (data, limit) => {
            if (data.length > limit) {
                return data.slice(-limit);
            }
            return data;
        };

        const latestLabels = latestData(labels, 10);

        const distance = {
            label: 'Jarak',
            data: latestData(distanceData, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 206, 86, 1)', // Different color for pH
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            fill: true,
        };

        const flowRate = {
            label: 'Laju Arus',
            data: latestData(flowRateData, 10),
            borderWidth: 1,
            borderColor: 'rgba(75, 192, 192, 1)', // Different color for humidity
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true,
        };

        const rainFall = {
            label: 'Curah Hujan',
            data: latestData(rainFallData, 10),
            borderWidth: 1,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: true,
        };


        new Chart(distancectx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [distance],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        new Chart(flowratectx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [flowRate],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        new Chart(rainfallctx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [rainFall],
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
