@extends('layout')
@section('title', 'Forgot Password')
@section('main')
<div class="login">
  <h4>Find Your Account</h4>
  <div class="card mt-2 shadow-none">
    <div class="card-body">
      <form action="{{ route('password.recovery') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="username">Email or Mobile Number</label>
          <input type="text" id="username" name="username" placeholder="Enter email or mobile number"
            class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
          @error('username')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="text-danger">{{ session('error') }}</div>

        <button type="submit" class="btn btn-primary btn-login mt-3">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection