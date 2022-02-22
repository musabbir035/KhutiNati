@section('title', 'Sellers')
<div>
  <div wire:loading>
    @livewire('loading')
  </div>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h4>Sellers</h4>
        </div>
        <div class="col-12 col-sm-6 text-sm-end">
          <a href="{{ route('admin.sellers.create') }}" class="btn btn-primary">Add new</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
          <input type="text" id="search" placeholder="Search sellers..." class="form-control input-slim"
            wire:model="search" wire:change="updateList">
        </div>
      </div>
      @if($sellers->count())
      <div class="table-responsive">
        <table class="table">
          <tr class="table-primary">
            <th>Image</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
          @foreach ($sellers as $seller)
          <tr>
            <td>
              <img
                src="{{ $seller->image ? asset('storage/images/sellers/'.$seller->image) : asset('img/no-image.png') }}"
                class="list-image" alt="">
            </td>
            <td>{{ $seller->name }}</td>
            <td><a href="tel:{{ $seller->mobile }}" class="text-decoration-none">{{ $seller->mobile }}</a></td>
            <td><a href="mailto:{{ $seller->email }}" class="text-decoration-none">{{ $seller->email }}</a></td>
            <td>{{ $seller->address }}</td>
            <td>
              <a href="{{ route('admin.sellers.show', ['seller' => $seller->id]) }}"
                class="btn btn-xs btn-info mt-1">Details</a>
              <a href="{{ route('admin.sellers.edit', ['seller' => $seller->id]) }}"
                class="btn btn-xs btn-warning mt-1">Edit</a>
              <a href="#" wire:click="$emit('deleteClick', '{{ $seller->id }}', '{{ $seller->name }}')"
                class="btn btn-xs btn-danger mt-1">Delete</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      @else
      <p class="text-center">No sellers to show</p>
      @endif
    </div>
  </div>
</div>
@section('livewireViewScripts')
<script>
  livewire.on('deleteClick', (id, name) => {
    Swal.fire({
      title: 'Deleting Seller',
      text: `Are you sure you want to delete seller: ${name}?`,
      icon: 'warning',
      confirmButtonText: 'Yes',
      showCancelButton: true,
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        livewire.emit('deleteSeller', id)
      }
    })
  })
  livewire.on('sellerDeleted', (title, msg, code) => {
		showFlashMessage(title, msg, code != 200 ? 'danger' : 'success');
	})
</script>
@endsection