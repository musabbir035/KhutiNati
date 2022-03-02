@extends('admin.layout')
@section('title', $category->name . ' - Edit Category')
@section('main')
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-md-6">
        <h4>Edit Category - {{ $category->name }}</h4>
      </div>
      <div class="col-12 col-md-6 text-md-end">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Category List</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST"
      enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="PUT">
      <div class="row">
        <div class="col-12 col-md-6 mb-2">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" placeholder="Enter a name"
            value="{{ old('name') ?? $category->name }}" class="form-control @error('name') is-invalid @enderror"
            required>
          @error('name')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="parent_id">Parent Category (optional)</label>
          <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
            <option value="">--Select a category--</option>
            @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @if( in_array($cat->id, [ old('parent_id'), $category->parent?->id]))
              selected
              @endif>
              {{ $cat->name }}
            </option>
            @endforeach
          </select>
          @error('category_id')
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
          <button class="btn btn-primary btn-submit" type="submit">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection