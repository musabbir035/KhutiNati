@extends('admin.layout')
@section('title', 'Add New Banner Image')
@section('main')
<nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.banner-images.index') }}">Banner Images</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add New</li>
  </ol>
</nav>
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.banner-images.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="image">Image</label>
          <input type="file" name="image" id="image" placeholder="Choose an image"
            class="form-control @error('image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp" required>
          @error('image')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" placeholder="Enter a title" value="{{ old('title') }}"
            class="form-control @error('title') is-invalid @enderror" required>
          @error('title')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="subtext">Subtext</label>
          <input type="text" name="subtext" id="subtext" placeholder="Enter a subtext" value="{{ old('subtext') }}"
            class="form-control @error('subtext') is-invalid @enderror" required>
          @error('subtext')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="col-12 col-md-6 mb-3">
          <label for="url">Url</label>
          <input type="text" name="url" id="url" placeholder="Enter a url" value="{{ old('url') }}"
            class="form-control @error('url') is-invalid @enderror" required>
          @error('url')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="type">Type</label>
          <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
            <option value="">Select a type</option>
            <option value="1" @if(old('type') === 1) selected @endif>Banner</option>
            <option value="2" @if(old('type') === 2) selected @endif>Slider</option>
          </select>
          @error('url')
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
