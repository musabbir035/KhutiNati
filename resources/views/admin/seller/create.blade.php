@extends('admin.layout')
@section('title', 'Add New Seller')
@section('main')
<nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('admin.sellers.index') }}">Sellers</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      Add New
    </li>
  </ol>
</nav>

<div class="card mt-4">
  <div class="card-body">
    <form action="{{ route('admin.sellers.store') }}" method="POST" enctype="multipart/form-data">
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
          <label for="email">Email Address (optional)</label>
          <input type="email" name="email" id="email" placeholder="Enter an email address" value="{{ old('email') }}"
            class="form-control @error('email') is-invalid @enderror">
          @error('email')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="mobile">Mobile Number (optional)</label>
          <input type="text" name="mobile" id="mobile" placeholder="Enter a mobile number" value="{{ old('mobile') }}"
            class="form-control @error('mobile') is-invalid @enderror" maxlength="11">
          @error('mobile')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="address">Address (optional)</label>
          <input type="text" name="address" id="address" placeholder="Enter an address" value="{{ old('address') }}"
            class="form-control @error('address') is-invalid @enderror">
          @error('address')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="description">Description (optional)</label>
          <input type="text" name="description" id="description" placeholder="Enter a description"
            value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror">
          @error('description')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="image">Image (optional)</label>
          <input type="file" name="image" id="image" placeholder="Choose an image"
            class="form-control @error('image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
          @error('image')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        @if (session('submit_error'))
        <p class="text-danger">{{ session('submit_error') }}</p>
        @endif

        <div class="col-12 mt-2">
          <button class="btn btn-primary btn-submit" type="submit">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection