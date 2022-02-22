@extends('admin.layout')
@section('title', 'Product Details')
@section('main')
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h4>Product Details - {{ $product->name }}</h4>
      </div>
      <div class="col-12 col-sm-6 mt-2 mt-sm-0 text-sm-end">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Product List</a>
        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-warning">Edit</a>
        <a href="#" id="delBtn" class="btn btn-danger">Delete</a>
        <form id="delForm" action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="DELETE">
        </form>
      </div>
    </div>
  </div>
  <div class="card-body">
    <img src="{{ asset($product->image_file) }}" alt="" class="mb-2 details-img">
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Name </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->name }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Category </label>
      <span class="col-12 col-md-8 col-lg-10">
        <a class="td-none" href="{{ route('admin.categories.show', ['category' => $product->category->name]) }}">
          {{ $product->category->name }}
        </a>
      </span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Seller </label>
      <span class="col-12 col-md-8 col-lg-10">
        @if($product->seller)
        <a class="td-none" href="{{ route('admin.sellers.show', ['seller' => $product->seller->id]) }}">
          {{ $product->seller->name }}
        </a>
        @endif
      </span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Inventory </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->inventory }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Unit </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->unit }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Price </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->price }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Discounted Price </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->discounted_price }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Is Featured? </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->is_featured ? 'Yes' : 'No' }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Slug </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->slug }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Description </label>
      <span class="col-12 col-md-8 col-lg-10">{!! $product->description !!}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Date Added </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->created_at->format('d-M-Y \a\t h:i a') }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Last Updated </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $product->updated_at->format('d-M-Y \a\t h:i a') }}</span>
    </div>
  </div>
</div>
@endsection
@section('pageScripts')
<script>
  document.querySelector('#delBtn').addEventListener('click', () => {
    Swal.fire({
      title: 'Deleting Product',
      text: 'Are you sure you want to delete this product?',
      icon: 'warning',
      confirmButtonText: 'Yes',
      showCancelButton: true,
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        document.querySelector('#delForm').submit()
      }
    })
  })
</script>
@endsection