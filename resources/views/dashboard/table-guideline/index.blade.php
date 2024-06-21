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
    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
        <h1 class="h2">Tabel Pedoman</h1>
        <h1 class="h6 fw-lighter">Tabel pedoman untuk menentukan indikator pada tiap parameter di tiap alat tanah dan air pintar</h1>
    </div>

    {{-- /Heading --}}
    {{-- leaflet full here --}}


    @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">Suhu</h1>
            <h1 class="h6 fw-lighter">pedoman suhu untuk menentukan indikator di sektor pertanian</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jangkauan</th>
                    <th scope="col">Indikator</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>< 18 atau > 35</td>
                        <td>Buruk</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>18 - 22 atau 32 - 25</td>
                        <td>Sedang</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>22 - 24 atau 29 - 32</td>
                        <td>Baik</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>24 - 29</td>
                        <td>Sangat Baik</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Lainnya</td>
                        <td>Di luar jangkauan</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">pH</h1>
            <h1 class="h6 fw-lighter">pedoman pH untuk menentukan indikator di sektor pertanian</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jangkauan</th>
                    <th scope="col">Indikator</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>< 5 atau > 7.9</td>
                        <td>Sedang</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>5 - 5.5 atau 7.5 - 7.9</td>
                        <td>Baik</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>5.5 - 7.5</td>
                        <td>Sangat Baik</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Lainnya</td>
                        <td>Di luar jangkauan</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">Kelembaban</h1>
            <h1 class="h6 fw-lighter">kelembaban untuk menentukan indikator di sektor pertanian</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jangkauan</th>
                    <th scope="col">Indikator</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>< 30 atau > 90</td>
                        <td>Sedang</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>30 - 33</td>
                        <td>Baik</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>33 - 90</td>
                        <td>Sangat Baik</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Lainnya</td>
                        <td>Di luar jangkauan</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">Nitrogen</h1>
            <h1 class="h6 fw-lighter">nitrogen untuk menentukan indikator di sektor pertanian</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jangkauan</th>
                    <th scope="col">Indikator</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>< 0.10</td>
                        <td>Sangat Rendah</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>0.10 - 0.20</td>
                        <td>Rendah</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>0.21 - 0.50</td>
                        <td>Sedang</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>0.51 - 0.75</td>
                        <td>Tinggi</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>> 0.75</td>
                        <td>Sangat Tinggi</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">Fosfor</h1>
            <h1 class="h6 fw-lighter">fosfor untuk menentukan indikator di sektor pertanian</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jangkauan</th>
                    <th scope="col">Indikator</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>< 0.021</td>
                        <td>Sangat Rendah</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>0.021 - 0.039</td>
                        <td>Rendah</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>0.040 - 0.060</td>
                        <td>Sedang</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>0.061 - 0.1</td>
                        <td>Tinggi</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>> 0.1</td>
                        <td>Sangat Tinggi</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">Kalium</h1>
            <h1 class="h6 fw-lighter">kalium untuk menentukan indikator di sektor pertanian</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jangkauan</th>
                    <th scope="col">Indikator</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>< 0.10</td>
                        <td>Sangat Rendah</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>0.10 - 0.20</td>
                        <td>Rendah</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>0.21 - 0.50</td>
                        <td>Sedang</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>0.51 - 1</td>
                        <td>Tinggi</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>> 1</td>
                        <td>Sangat Tinggi</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">Konduktivitas Listrik</h1>
            <h1 class="h6 fw-lighter">konduktivitas listrik untuk menentukan indikator di sektor pertanian</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jangkauan</th>
                    <th scope="col">Indikator</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td><= 20</td>
                        <td>Buruk</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>21 - 25</td>
                        <td>Baik</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>> 25</td>
                        <td>Sangat Baik</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive col-lg-12 mt-2 border-bottom">
        <table class="table table-striped table-sm align-middle">
            <h1 class="h5">Jarak, Laju Arus, Curah Hujan</h1>
            <h1 class="h6 fw-lighter">jarak, laju arus, dan curah hujan untuk menentukan indikator di sektor pengairan/irigasi</h1>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Parameter</th>
                    <th scope="col">Jarak (cm)</th>
                    <th scope="col">Laju Arus (L/menit)</th>
                    <th scope="col">Curah Hujan (mm)</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>Baik</td>
                        <td>337.6 - 450 (Ketinggian 1 | Baik)</td>
                        <td>0 - 7.5 (Lambat)</td>
                        <td>0 - 100 (Rendah)</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sedang</td>
                        <td>225.1 - 337.5 (Ketinggian 2 | Sedang)</td>
                        <td>7.6 - 15 (Sedang)</td>
                        <td>101 - 300 (Sedang)</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Peringatan</td>
                        <td>112.6 - 225 (Ketinggian 3 | Waspada)</td>
                        <td>15.1 - 22.5 (Cepat)</td>
                        <td>301 - 500 (Tinggi)</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Berbahaya</td>
                        <td>0 - 112.5 (Ketinggian 4 | Bahaya)</td>
                        <td>22.6 - 30 (Sangat Cepat)</td>
                        <td>> 500 (Sangat Tinggi)</td>
                    </tr>
            </tbody>
        </table>
    </div>
    
@endsection
