@section('title', 'Products')
<div>
  <div wire:loading>
    @livewire('loading')
  </div>
  <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Products</li>
      <li class="breadcrumb-item ms-auto" style="--bs-breadcrumb-divider: '';">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">Add New</a>
      </li>
    </ol>
  </nav>

  <div class="card mt-4">
    <div class="card-body">
      <div class="row">
        @if(!$isCategoryDetailsPage)
        <div class="col-12 col-md-6 col-lg-4 mb-3">
          <div class="input-group">
            <label class="input-group-text input-slim" for="categoryId">Showing</label>
            <select id="categoryId" class="form-select input-slim" wire:model="categoryId" wire:change="updateList">
              <option value="">All categories</option>
              @foreach ($categories as $cat)
              <option value="{{ $cat->id }}" @if(app('request')->input('category') == $cat->id) selected @endif>
                {{ $cat->name }}
              </option>
              @endforeach
            </select>
          </div>
        </div>
        @endif
        <div class="col-12 col-md-6 col-lg-4 mb-3">
          <input type="text" id="search" placeholder="Search products..." class="form-control input-slim"
            wire:model="search" wire:change="updateList">
        </div>
      </div>
      {{ $products->links() }}
      @if($products->count())
      <div class="table-responsive mt-1">
        <table class="table">
          <tr class="table-primary">
            <th>Image</th>
            <th>Name</th>
            @if(!$isCategoryDetailsPage)
            <th>Category</th>
            @endif
            <th>Inventory</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Discounted Price</th>
            <th>Is Featured</th>
            <th>Actions</th>
          </tr>
          @foreach ($products as $product)
          <tr>
            <td>
              <img src="{{ asset($product->image ? 'storage/images/products/'.$product->image : 'img/no-image.png') }}"
                class="list-image" alt="">
            </td>
            <td>{{ $product->name }}</td>
            @if(!$isCategoryDetailsPage)
            <td>{{ $product->category->name }}</td>
            @endif
            <td>{{ $product->inventory }}</td>
            <td>{{ $product->unit }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->discounted_price }}</td>
            <td>{{ $product->is_featured === 1 ? 'Yes' : 'No' }}</td>
            <td>
              <a href="{{ route('admin.products.show', ['product' => $product->id]) }}"
                class="btn btn-xs btn-info mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Details">
								<i class="fa-solid fa-file-lines"></i>
              </a>
              <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                class="btn btn-xs btn-warning mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Edit">
								<i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a href="#" wire:click="$emit('deleteClick', '{{ $product->id }}', '{{ $product->name }}')"
                class="btn btn-xs btn-danger mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Delete">
								<i class="fa-solid fa-trash-can"></i></a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      @else
      <p class="text-center">No products to show</p>
      @endif
    </div>
  </div>
</div>
@section('livewireViewScripts')
<script>
  livewire.on('deleteClick', (id, name) => {
    Swal.fire({
      title: 'Deleting Product',
      text: `Are you sure you want to delete product: ${name}?`,
      icon: 'warning',
      confirmButtonText: 'Yes',
      showCancelButton: true,
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        livewire.emit('deleteProduct', id)
      }
    })
  })
  livewire.on('productDeleted', (title, msg, code) => {
		showFlashMessage(title, msg, code != 200 ? 'danger' : 'success');
	})
</script>
@endsection