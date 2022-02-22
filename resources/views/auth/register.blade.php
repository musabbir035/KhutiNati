@extends('layout')
@section('title', 'Register')
@section('main')
<div class="login">
  <h4>Create an account.</h4>
  <p class="font-sm text-center">
    Already have an account?
    <a href="{{ route('login') }}" class="link-primary text-decoration-none">Login here.</a>
  </p>
  <div class="card mt-2 register-card">
    <div class="card-body">
      <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter full name" class="form-control mb-3">
            <label for="email">Email Address</label>
            <input type="text" id="email" name="email" placeholder="Enter email address" class="form-control mb-3">
          </div>

          <div class="col-12 col-md-6">
            <label for="mobile">Mobile Number</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter mobile number" class="form-control mb-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" class="form-control mb-3">
          </div>

          <div class="col-12 col-md-6">
            <button type="submit" class="btn btn-primary btn-login">Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
