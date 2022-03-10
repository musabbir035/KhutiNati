@extends('layout')
@section('title', 'Register')
@section('main')
<div class="login">
  <h4>Create an account.</h4>
  <p class="font-sm text-center">
    Already have an account?
    <a href="{{ route('login') }}" class="link-primary text-decoration-none">Login here.</a>
  </p>
  <div class="card mt-2 register-card shadow-none">
    <div class="card-body">
      <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter full name"
              class="form-control mt-1 @error('name') is-invalid @enderror">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="email" class="mt-3">Email Address</label>
            <input type="text" id="email" name="email" placeholder="Enter email address"
              class="form-control mt-1 @error('email') is-invalid @enderror">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12 col-md-6">
            <label for="mobile">Mobile Number</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter mobile number"
              class="form-control mt-1 @error('mobile') is-invalid @enderror">
            @error('mobile')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="password" class="mt-3">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password"
              class="form-control mt-1 @error('password') is-invalid @enderror">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="text-danger mt-3">{{ session('error') }}</div>

          <div class="col-12 col-md-6 mt-4">
            <button type="submit" class="btn btn-primary btn-wide">Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection