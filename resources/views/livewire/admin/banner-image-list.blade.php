@section('title', 'Banner Images')
<div>
  <div wire:loading>
    @livewire('loading')
  </div>
  <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Banner Images</li>
      <li class="breadcrumb-item ms-auto" style="--bs-breadcrumb-divider: '';">
        <a href="{{ route('admin.banner-images.create') }}" class="btn btn-primary btn-sm">Add new</a>
      </li>
    </ol>
  </nav>
  <div class="card mt-4">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
          <input type="text" id="search" placeholder="Search by title..." class="form-control input-slim"
            wire:model="search" wire:change="updateList">
        </div>
      </div>
      {{ $images->links() }}
      @if($images->count())
      <div class="table-responsive">
        <table class="table">
          <tr class="table-primary">
            <th>Image</th>
            <th>Title</th>
            <th>Subtext</th>
            <th>Type</th>
            <th>Url</th>
            <th>Actions</th>
          </tr>
          @foreach ($images as $image)
          <tr>
            <td>
              <img src="{{ $image->image ? asset('storage/images/banners/'.$image->image) : asset('img/no-image.png') }}"
                class="list-image" alt="">
            </td>
            <td>{{ $image->title }}</td>
            <td>{{ $image->subtext }}</td>
            <td>{{ $image->type === 1 ? 'Banner' : 'Slider' }}</td>
            <td>{{ $image->url }}</td>
            <td>
              <a href="{{ route('admin.banner-images.edit', ['banner_image' => $image->id]) }}"
                class="btn btn-xs btn-warning mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Edit">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a href="#" wire:click="$emit('deleteClick', '{{ $image->id }}')"
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
      <p class="text-center">No images to show</p>
      @endif
    </div>
  </div>
</div>
@section('livewireViewScripts')
<script>
  livewire.on('deleteClick', (id) => {
    Swal.fire({
      title: 'Deleting Category',
      text: `Are you sure you want to delete this banner image?`,
      icon: 'warning',
      confirmButtonText: 'Yes',
      showCancelButton: true,
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        livewire.emit('deleteBannerImage', id)
      }
    })
  })
  livewire.on('bannerImageDeleted', (title, msg, code) => {
		showFlashMessage(title, msg, code != 200 ? 'danger' : 'success');
	})
</script>
@endsection