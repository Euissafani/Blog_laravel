@extends('layout.main')

@section('container')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
{{-- If-else untuk menampilkan pesan berhasil dari boostrap --}}
      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
       @endif

       @if(session()->has('loginEroor'))
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
         {{ session('loginEroor') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
        @endif

        <main class="form-signin w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Please Login </h1>
            <form action="/login" method="post">
              @csrf
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" autofocus required placeholder="name@example.com"  autofocus required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password"  required>
                <label for="password">Password</label>
              </div>
              <button class="w-100 btn btn-lg btn-danger" type="submit">Login</button>
            </form>

            <small class="d-block text-center mt-4">
                Not registered ? <a href="/register">Register Now!</a>
            </small>
        </main>
    </div>
</div>
  
@endsection