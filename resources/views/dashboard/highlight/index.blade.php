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
    <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">Sorotan</a></div>
    <div class="breadcrumb-item active">Halaman saat ini</div>
  </div>

{{-- /Heading --}}
{{-- leaflet full here --}}


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3  border-bottom">
   
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-9" role="alert">
  {{ session('success') }}
</div>
@endif
   
<div class="table-responsive col-lg-9">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Gambar</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($highlights as $highlight)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $highlight->title }}</td>
              <td>{{ $highlight->image }}</td>
              <td>  
                <!-- Modal -->
            <!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Sorotan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('highlight.update', $highlight->id) }}" method="post" enctype="multipart/form-data">                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="editTitle" name="title" value="{{ $highlight->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="newImage" class="form-label">Gambar baru</label>
                        <input type="file" class="form-control" id="newImage" name="image">
                    </div>

                    <input type="hidden" name="highlight_id" value="{{ $highlight->id }}">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

            <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg> Edit
            </a>
            
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>



@endsection

