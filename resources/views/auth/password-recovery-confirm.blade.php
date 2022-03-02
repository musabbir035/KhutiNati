@extends('layout')
@section('title', 'Forgot Password')
@section('main')
<div class="login">
  <h4>Confirm Password Recovery</h4>
  <p class="font-sm text-center">

  </p>
  <div class="card mt-2 shadow-none">
    <div class="card-body">
      <form action="{{ route('password.recovery.confirm') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="code">An email is sent to your email address with a code. Please submit the code
            here.</label>
          <input type="text" id="code" name="code" placeholder="Enter code"
            class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
          @error('code')
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