@extends('admin.layout')
@section('title', 'Add New User')
@section('main')
<nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('admin.users.index') }}">Users</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      Add New
    </li>
  </ol>
</nav>
<div class="card mt-4">
  <div class="card-body">
    <form action="{{ route('admin.users.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-12 col-md-6 mb-2">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" placeholder="Enter a name" value="{{ old('name') }}"
            class="form-control @error('name') is-invalid @enderror" required>
          @error('name')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="Enter an email address" value="{{ old('email') }}"
            class="form-control @error('email') is-invalid @enderror" required>
          @error('email')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="mobile">Mobile Number</label>
          <input type="text" name="mobile" id="mobile" placeholder="Enter a mobile number" value="{{ old('mobile') }}"
            class="form-control @error('mobile') is-invalid @enderror" maxlength="11" required>
          @error('mobile')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Enter a password"
            class="form-control @error('password') is-invalid @enderror" required>
          @error('password')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 mt-2">
          <button class="btn btn-primary btn-submit" type="submit">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection