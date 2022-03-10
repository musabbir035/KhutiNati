@extends('admin.layout')
@section('title', $product->name . ' - Edit Product')
@section('main')
<nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('admin.products.index') }}">Products</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.products.show', ['product' => $product->id]) }}">
        {{ $product->name }}
      </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      Edit
    </li>
  </ol>
</nav>

<div class="card mt-4">
  <div class="card-body">
    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST" id="editForm"
      enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="PUT">
      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" placeholder="Enter a name"
            value="{{ old('name') ? old('name') : $product->name }}"
            class="form-control @error('name') is-invalid @enderror" required>
          @error('name')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="category_id">Category</label>
          <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror"
            required>
            <option value="">--Select a category--</option>
            @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @if(in_array($cat->id, [old('category_id'), $product->category_id])) selected
              @endif
              >
              {{ $cat->name }}
            </option>
            @endforeach
          </select>
          @error('category_id')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="price">Price</label>
          <input type="number" name="price" id="price" placeholder="Enter price"
            value="{{ old('price') ? old('price') : $product->price }}"
            class="form-control @error('price') is-invalid @enderror" required>
          @error('price')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="discounted_price">Discounted Price (optional)</label>
          <input type="number" name="discounted_price" id="discounted_price" placeholder="Enter discounted price"
            value="{{ old('discounted_price') ? old('discounted_price') : $product->discounted_price }}"
            class="form-control @error('discounted_price') is-invalid @enderror">
          @error('discounted_price')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="unit">Unit</label>
          <input type="text" name="unit" id="unit" placeholder="Enter an unit"
            value="{{ old('unit') ? old('unit') : $product->unit }}"
            class="form-control @error('unit') is-invalid @enderror" required>
          @error('unit')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="is_featured">Is it a featured product? (optional)</label>
          <select name="is_featured" id="is_featured" class="form-select @error('is_featured') is-invalid @enderror">
            <option value="">--Select an option--</option>
            <option value="1" @if(in_array(1, [old('is_featured'), $product->is_featured])) selected @endif>Yes</option>
            <option value="2" @if(in_array(2, [old('is_featured'), $product->is_featured])) selected @endif>No</option>
          </select>
          @error('is_featured')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="inventory">Inventory</label>
          <input type="number" name="inventory" id="inventory" placeholder="Enter number of products available"
            value="{{ old('inventory') ?? $product->inventory }}"
            class="form-control @error('inventory') is-invalid @enderror" required>
          @error('inventory')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="seller_id">Seller (optional)</label>
          <select name="seller_id" id="seller_id" class="form-select @error('seller_id') is-invalid @enderror">
            <option value="">--Select a seller--</option>
            @foreach ($sellers as $seller)
            <option value="{{ $seller->id }}" @if(in_array($seller->id, [old('seller_id'), $product->seller_id]))
              selected @endif
              >
              {{ $seller->name }}
            </option>
            @endforeach
          </select>
          @error('seller_id')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="descriptionEditor">Description (optional)</label>
          <div id="descriptionEditor">{!! old('description') ? old('description') : $product->description !!}</div>
          @error('description')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <input type="hidden" name="description" id="description">

        <div class="col-12 col-md-6 mb-3">
          <label for="image">Image (optional)</label>
          <input type="file" name="image" id="image" placeholder="Enter an unit"
            class="form-control @error('image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
          <img class="img-upload-preview"
            src="{{ asset($product->image ? 'storage/images/products/'.$product->image : 'img/no-image.png') }}" alt=""
            data-img-preview>
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
@section('pageScripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
  let description = document.querySelector('#descriptionEditor');
  var editor = new Quill(description, {
    modules: {
      toolbar: [
        [{ header: [2, 3, false] }],
        ['bold', 'italic'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }]
      ]
    },
    placeholder: 'Enter product description',
    theme: 'snow'
  });
  const form = document.querySelector('#editForm');
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    document.querySelector('#description').value = editor.root.innerHTML;
    form.submit();
  })

  document.querySelector('#image').addEventListener('change', () => {
    const file = document.querySelector('#image').files[0]
    const preview = document.querySelector('[data-img-preview]');
    if (file) {
      preview.src = URL.createObjectURL(file);
      return;
    }
    preview.src = '{{ asset($product->image ? 'storage/images/products/'.$product->image : 'img/no-image.png') }}';
  })
</script>
@endsection