@extends('dashboard.layouts.main')

@section('container')
    <style>
        /* Breadcrumb container */
        .breadcrumb {
            padding: 10px 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Breadcrumb items */
        .breadcrumb-item {
            display: inline-block;
            margin-right: 5px;
        }

        /* Link styling */
        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Separator */
        .breadcrumb-item::after {
            content: '>';
            margin-left: 5px;
            margin-right: 5px;
            color: #6c757d;
        }

        /* Active page */
        .breadcrumb-item.active {
            color: #6c757d;
        }
        
    </style>

    {{-- Heading --}}
    <div class="breadcrumb mt-4 mb-0">
        <div class="breadcrumb-item"><a href="#">Tanah Pintar 2</a></div>
        <div class="breadcrumb-item"><a href="#">Pengukuran</a></div>
        <div class="breadcrumb-item active">Halaman saat ini</div>
    </div>

    {{-- /Heading --}}
    {{-- leaflet full here --}}


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3  border-bottom">

    </div>


    @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-12">
        <a href="/dashboard/measurement-2/create" class="btn btn-primary mb-3">Tambah Pengukuran</a>
        <table class="table table-striped table-sm align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">pH</th>
                    <th scope="col">Kelembaban</th>
                    <th scope="col">Nitrogen</th>
                    <th scope="col">Fosfor</th>
                    <th scope="col">Kalium</th>
                    <th scope="col">ID Lokasi</th>
                    <th scope="col">Garis Lintang (Latitude)</th>
                    <th scope="col">Garis Bujur (Longitude)</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($measurements2 as $measurement2)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $measurement2->ph }}</td>
                        <td>{{ $measurement2->moisture }}%</td>
                        <td>{{ $measurement2->nitrogen }}</td>
                        <td>{{ $measurement2->phosporus }}</td>
                        <td>{{ $measurement2->potassium }}</td>
                        <td>{{ $measurement2->idLocation }}</td>
                        <td>{{ $measurement2->latitude }}</td>
                        <td>{{ $measurement2->longitude }}</td>
                        <td>{{ $measurement2->updated_at }}</td>
                        <td>
                            <a href="/dashboard/measurement-2/{{ $measurement2->idMeasurement }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/measurement-2/{{ $measurement2->idMeasurement }}/edit"
                                class="badge bg-warning"><span data-feather="edit"></span></a>

                            <form action="/dashboard/measurement-2/{{ $measurement2->idMeasurement }}" method="post"
                                class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0"
                                    onclick="return confirm('Anda yakin akan menghapus data pengukuran ini?')">
                                    <span data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
