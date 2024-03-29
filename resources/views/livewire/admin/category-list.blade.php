@section('title', 'Categories')
<div>
  <div wire:loading>
    @livewire('loading')
  </div>
  <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Categories</li>
      <li class="breadcrumb-item ms-auto" style="--bs-breadcrumb-divider: '';">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">Add New</a>
      </li>
    </ol>
  </nav>

  <div class="card mt-4">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
          <input type="text" id="search" placeholder="Search categories..." class="form-control input-slim"
            wire:model="search" wire:change="updateList">
        </div>
      </div>
      {{ $categories->links() }}
      @if($categories->count())
      <div class="table-responsive">
        <table class="table">
          <tr class="table-primary">
            <th>Image</th>
            <th>Name</th>
            <th>Parent Category</th>
            <th>Actions</th>
          </tr>
          @foreach ($categories as $cat)
          <tr>
            <td>
              <img src="{{ $cat->image ? asset('storage/images/categories/'.$cat->image) : asset('img/no-image.png') }}"
                class="list-image" alt="">
            </td>
            <td>{{ $cat->name }}</td>
            <td>
              @if($cat->parent)
              <a href="{{ route('admin.categories.show', ['category' => $cat->parent->id]) }}" class="td-none">
                {{ $cat->parent->name }}
              </a>
              @endif
            </td>
            <td>
              <a href="{{ route('admin.categories.show', ['category' => $cat->id]) }}"
                class="btn btn-xs btn-info mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Details">
								<i class="fa-solid fa-file-lines"></i>
              </a>
              <a href="{{ route('admin.categories.edit', ['category' => $cat->id]) }}"
                class="btn btn-xs btn-warning mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Edit">
								<i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a href="#" wire:click="$emit('deleteClick', '{{ $cat->id }}', '{{ $cat->name }}')"
                class="btn btn-xs btn-danger mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Delete">
								<i class="fa-solid fa-trash-can"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      @else
      <p class="text-center">No categories to show</p>
      @endif
    </div>
  </div>
</div>
@section('livewireViewScripts')
<script>
  livewire.on('deleteClick', (id, name) => {
    Swal.fire({
      title: 'Deleting Category',
      text: `Are you sure you want to delete category: ${name}?`,
      icon: 'warning',
      confirmButtonText: 'Yes',
      showCancelButton: true,
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        livewire.emit('deleteCategory', id)
      }
    })
  })
  livewire.on('categoryDeleted', (title, msg, code) => {
		showFlashMessage(title, msg, code != 200 ? 'danger' : 'success');
	})
</script>
@endsection