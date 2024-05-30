@extends('dashboard.layouts.main')

@section('container')
    {{-- leaflet full here --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
        <h1 class="h2">Selamat datang, {{ auth()->user()->name }}</h1>
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

        const labels = {!! json_encode(
            $measurements->pluck('created_at')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d-m H:i:s');
            }),
        ) !!};

        const labels2 = {!! json_encode(
            $measurements2->pluck('created_at')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d-m H:i:s');
            }),
        ) !!};

        const labels3 = {!! json_encode(
            $measurements3->pluck('created_at')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d-m H:i:s');
            }),
        ) !!};

        const temperatureData = {!! json_encode($measurements->pluck('temperature')) !!};
        const phData = {!! json_encode($measurements->pluck('ph')) !!};
        const moistureData = {!! json_encode($measurements->pluck('moisture')) !!};
        const nitrogenData = {!! json_encode($measurements->pluck('nitrogen')) !!};
        const phosphorusData = {!! json_encode($measurements->pluck('phosporus')) !!};
        const potassiumData = {!! json_encode($measurements->pluck('potassium')) !!};
        const ecData = {!! json_encode($measurements->pluck('ec')) !!};

        const phData2 = {!! json_encode($measurements2->pluck('ph')) !!};
        const moistureData2 = {!! json_encode($measurements2->pluck('moisture')) !!};
        const nitrogenData2 = {!! json_encode($measurements2->pluck('nitrogen')) !!};
        const phosphorusData2 = {!! json_encode($measurements2->pluck('phosporus')) !!};
        const potassiumData2 = {!! json_encode($measurements2->pluck('potassium')) !!};

        const distanceData = {!! json_encode($measurements3->pluck('distance')) !!};
        const flowRateData = {!! json_encode($measurements3->pluck('flowRate')) !!};
        const rainFallData = {!! json_encode($measurements3->pluck('rainFall')) !!};

        const latestData = (data, limit) => {
            if (data.length > limit) {
                return data.slice(-limit);
            }
            return data;
        };

        const latestData2 = (data, limit) => {
            if (data.length > limit) {
                return data.slice(-limit);
            }
            return data;
        };

        const latestData3 = (data, limit) => {
            if (data.length > limit) {
                return data.slice(-limit);
            }
            return data;
        };

        const latestLabels = latestData(labels, 10);
        const latestLabels2 = latestData2(labels2, 10);
        const latestLabels3 = latestData3(labels3, 10);

        const temperature = {
            label: 'Suhu',
            data: latestData(temperatureData, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            fill: false,
        };

        const ph = {
            label: 'pH',
            data: latestData(phData, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 206, 86, 1)', // Different color for pH
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            fill: false,
        };

        const moisture = {
            label: 'Kelembaban',
            data: latestData(moistureData, 10),
            borderWidth: 1,
            borderColor: 'rgba(75, 192, 192, 1)', // Different color for humidity
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: false,
        };

        const nitrogen = {
            label: 'Nitrogen',
            data: latestData(nitrogenData, 10),
            borderWidth: 1,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: false,
        };

        const phosporus = {
            label: 'Fosfor',
            data: latestData(phosphorusData, 10),
            borderWidth: 1,
            borderColor: 'rgba(153, 102, 255, 1)', // Different color for phosphorus
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            fill: false,
        };

        const potassium = {
            label: 'Kalium',
            data: latestData(potassiumData, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 159, 64, 1)', // Different color for potassium
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            fill: false,
        };

        const ec = {
            label: 'Konduktivitas Listrik',
            data: latestData(ecData, 10),
            borderWidth: 1,
            borderColor: 'rgba(128, 123, 128, 1)',
            backgroundColor: 'rgba(128, 128, 128, 0.2)',
            fill: false,
        };

        const ph2 = {
            label: 'pH',
            data: latestData2(phData2, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 206, 86, 1)', // Different color for pH
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            fill: false,
        };

        const moisture2 = {
            label: 'Kelembaban',
            data: latestData2(moistureData2, 10),
            borderWidth: 1,
            borderColor: 'rgba(75, 192, 192, 1)', // Different color for humidity
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: false,
        };

        const nitrogen2 = {
            label: 'Nitrogen',
            data: latestData2(nitrogenData2, 10),
            borderWidth: 1,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: false,
        };

        const phosporus2 = {
            label: 'Fosfor',
            data: latestData2(phosphorusData2, 10),
            borderWidth: 1,
            borderColor: 'rgba(153, 102, 255, 1)', // Different color for phosphorus
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            fill: false,
        };

        const potassium2 = {
            label: 'Kalium',
            data: latestData2(potassiumData2, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 159, 64, 1)', // Different color for potassium
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            fill: false,
        };

        const distance = {
            label: 'Jarak',
            data: latestData3(distanceData, 10),
            borderWidth: 1,
            borderColor: 'rgba(255, 206, 86, 1)', // Different color for potassium
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            fill: false,
        };

        const flowRate = {
            label: 'Laju Arus',
            data: latestData3(flowRateData, 10),
            borderWidth: 1,
            borderColor: 'rgba(75, 192, 192, 1)', // Different color for potassium
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: false,
        };

        const rainFall = {
            label: 'Curah Hujan',
            data: latestData3(rainFallData, 10),
            borderWidth: 1,
            borderColor: 'rgba(54, 162, 235, 1)', // Different color for potassium
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: false,
        };


        new Chart(ctx, {
            type: 'line',
            data: {
                labels: latestLabels,
                datasets: [temperature, ph, moisture, nitrogen, phosporus, potassium, ec],
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
                labels: latestLabels2,
                datasets: [ph2, moisture2, nitrogen2, phosporus2, potassium2],
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
                labels: latestLabels3,
                datasets: [distance, flowRate, rainFall],
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
