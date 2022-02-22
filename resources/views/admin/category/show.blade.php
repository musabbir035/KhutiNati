@extends('admin.layout')
@section('title', $category->name . ' - Category Details')
@section('main')
<div class="card mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h4>Category Details - {{ $category->name }}</h4>
      </div>
      <div class="col-12 col-sm-6 mt-2 mt-sm-0 text-sm-end">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Category List</a>
        <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-warning">Edit</a>
        <a href="#" id="delBtn" class="btn btn-danger">Delete</a>
        <form id="delForm" action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
          method="POST">
          @csrf
          <input type="hidden" name="_method" value="DELETE">
        </form>
      </div>
    </div>
  </div>
  <div class="card-body">
    <img src="{{ asset($category->image_file) }}" alt="" class="mb-2 details-img">
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Name </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $category->name }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Parent Category </label>
      <span class="col-12 col-md-8 col-lg-10">
        @if($category->parent)
        <a href="{{ route('admin.categories.show', ['category' => $category->parent->id]) }}" class="td-none">
          {{ $category->parent->name }}
        </a>
        @endif
      </span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Number of products </label>
      <span class="col-12 col-md-8 col-lg-10" id="productCount">{{ $products_count }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Slug </label>
      <span class="col-12 col-md-8 col-lg-10">{{ $category->slug }}</span>
    </div>
  </div>
</div>

<livewire:admin.product-list :categoryId="$category->id" :isCategoryDetailsPage="true" />
@endsection
@section('pageScripts')
<script>
  document.querySelector('#delBtn').addEventListener('click', () => {
    Swal.fire({
      title: 'Deleting Category',
      text: 'Are you sure you want to delete this category?',
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