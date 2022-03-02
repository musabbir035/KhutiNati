@extends('layout')
@section('title', 'Login')
@section('main')
<div class="login">
  <h4>Welcome! Login to Khutinati.</h4>
  <p class="font-sm text-center">
    New customer?
    <a href="{{ route('register') }}" class="link-primary text-decoration-none">Register here.</a>
  </p>
  <div class="card mt-2 shadow-none">
    <div class="card-body">
      <form action="{{ route('authenticate') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="username">Email or Mobile Number</label>
          <input type="text" id="username" name="username" placeholder="Enter email or mobile number"
            class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
          @error('username')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-2">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password"
            class="form-control @error('password') is-invalid @enderror">
          @error('password')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
          <label class="form-check-label" for="remember">
            Remember login
          </label>
        </div>

        <div class="text-danger">{{ session('error') }}</div>

        <button type="submit" class="btn btn-primary btn-login mt-3">Login</button>
      </form>
      <a href="{{ route('password.recovery.form') }}" class="link-primary text-decoration-none font-sm">Forgot
        password?</a>
    </div>
  </div>
</div>
@endsection