@section('title', 'Coupon Codes')
<div>
  <div wire:loading>
    @livewire('loading')
  </div>
  <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Coupon Codes</li>
      <li class="breadcrumb-item ms-auto" style="--bs-breadcrumb-divider: '';">
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm">Add New</a>
      </li>
    </ol>
  </nav>

  <div class="card mt-4">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
          <input type="text" id="search" placeholder="Search coupon codes..." class="form-control input-slim"
            wire:model="search" wire:change="updateList">
        </div>
      </div>
      {{ $coupons->links() }}
      @if($coupons->count())
      <div class="table-responsive">
        <table class="table">
          <tr class="table-primary">
            <th>Code</th>
            <th>Validity Start</th>
            <th>Validity End</th>
            <th>Discount</th>
            <th>Max. Discount</th>
            <th>Validity Status</th>
            <th>Actions</th>
          </tr>
          @foreach ($coupons as $coupon)
          <tr>
            <td>{{ $coupon->code }}</td>
            <td>{{ date('d-M-Y h:i a', strtotime($coupon->validity_start)) }}</td>
            <td>{{ date('d-M-Y h:i a', strtotime($coupon->validity_end)) }}</td>
            <td>{{ $coupon->discount_percentage }}%</td>
            <td>৳{{ $coupon->maximum_discount }}</td>
            <td data-countdown-timer="{{ $coupon->validity_end }}"></td>
            <td>
              <a href="{{ route('admin.coupons.edit', ['coupon' => $coupon->id]) }}"
                class="btn btn-xs btn-warning mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Edit">
								<i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a href="#" wire:click="$emit('deleteClick', '{{ $coupon->id }}', '{{ $coupon->code }}')"
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
      <p class="text-center">No coupon codes to show</p>
      @endif
    </div>
  </div>
</div>
@section('livewireViewScripts')
<script>
  livewire.on('deleteClick', (id, name) => {
    Swal.fire({
      title: 'Deleting Coupon Code',
      text: `Are you sure you want to delete coupon code: ${name}?`,
      icon: 'warning',
      confirmButtonText: 'Yes',
      showCancelButton: true,
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        livewire.emit('deleteCoupon', id)
      }
    })
  })
  livewire.on('couponDeleted', (title, msg, code) => {
    showFlashMessage(title, msg, code != 200 ? 'danger' : 'success');
  })

  let timerElements = document.querySelectorAll('[data-countdown-timer]');
  timerElements.forEach(element => {
    coundownTimer(element, element.dataset.countdownTimer)
  });
</script>
@endsection