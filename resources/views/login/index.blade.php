@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
<div class="col-md-4">

  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if(session()->has('loginError'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('loginError') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

<main class="form-signin">
    <form action="/login" method="post">
      @csrf
      <h1 class="h4 mb-3 fw-normal text-center">Masuk di sini</h1>     
      <div class="form-floating">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
        <label for="email">Alamat email</label>
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-dark mt-2" type="submit">Masuk</button>
    </form>
    {{-- <small class="d-block text-center mt-2">Not regsistered? <a href="/register">Register now!</a></small> --}}
  </main>
</div>
</div>
  
@endsection

