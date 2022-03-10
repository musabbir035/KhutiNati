@extends('admin.layout')
@section('title', $seller->name . ' - Seller Details')
@section('main')
<nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('admin.sellers.index') }}">Sellers</a>
    </li>
    <li class="breadcrumb-item active">
      {{ $seller->name }}
    </li>
  </ol>
</nav>

<div class="card mb-4 mt-4">
  <div class="card-body">
    <div class="row">
      <div class="col-12 text-sm-end">
        <a href="{{ route('admin.sellers.edit', ['seller' => $seller->id]) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="#" id="delBtn" class="btn btn-danger btn-sm">Delete</a>
        <form id="delForm" class="d-none" action="{{ route('admin.sellers.destroy', ['seller' => $seller->id]) }}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="DELETE">
        </form>
      </div>
    </div>

    <img src="{{ asset($seller->image_file) }}" alt="" class="mb-2 details-img">
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Name </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $seller->name }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Number of products </label>
      <span class="col-12 col-md-8 col-lg-10" id="productCount">{{ $seller->products_count }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Mobile</label>
      <span class="col-12 col-md-8 col-lg-10">
        <a class="text-decoration-none" href="tel:{{ $seller->mobile }}">{{ $seller->mobile }}</a>
      </span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Email</label>
      <span class="col-12 col-md-8 col-lg-10">
        <a class="text-decoration-none" href="mailto:{{ $seller->email }}">{{ $seller->email }}</a>
      </span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Address</label>
      <span class="col-12 col-md-8 col-lg-10">{{ $seller->address }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Description</label>
      <span class="col-12 col-md-8 col-lg-10">{{ $seller->description }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Date added</label>
      <span class="col-12 col-md-8 col-lg-10">{{ $seller->created_at->format('d-M-Y \a\t h:i a') }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Last updated</label>
      <span class="col-12 col-md-8 col-lg-10">{{ $seller->updated_at->format('d-M-Y \a\t h:i a') }}</span>
    </div>
  </div>
</div>

<livewire:admin.product-list :sellerId="$seller->id" />
@endsection
@section('pageScripts')
<script>
  document.querySelector('#delBtn').addEventListener('click', () => {
    Swal.fire({
      title: 'Deleting Product',
      text: 'Are you sure you want to delete this seller?',
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
  livewire.on('productDeleted', (title, msg, code) => {
		let variant = code == 200 ? 'success' : 'danger';
    let countEl = document.querySelector('#productCount')
    let count = countEl.innerText;
    countEl.innerText = count - 1;
	})
</script>
@endsection