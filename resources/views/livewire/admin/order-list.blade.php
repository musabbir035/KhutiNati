@section('title', 'Orders')
<div>
  <div wire:loading>
    @livewire('loading')
  </div>
  <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Orders</li>
    </ol>
  </nav>

  <div class="card mt-4">
    <div class="card-body">
      @if($orders->count())
      <div class="table-responsive">
        <table class="table">
          <tr class="table-primary">
            <th>Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Total</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          @foreach ($orders as $order)
          <tr>
            <td>{{ $order->address->name }}</td>
            <td>{{ $order->address->mobile }}</td>
            <td>
              {{ $order->address->address }},
              {{ $order->address->area->name }},
              {{ $order->address->district->name }},
              {{ $order->address->division->name }}
            </td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->date->format('d-M-Y \a\t h:i a') }}</td>
            <td>
              @if($order->status == \App\Models\Order::$AWAITING_CONFIRMATION)
              <span class="text-danger">Awaiting Confirmation</span>
              @elseif($order->status == \App\Models\Order::$PROCESSING)
              <span class="text-warning">Processing</span>
              @elseif($order->status == \App\Models\Order::$DELIVERED)
              <span class="text-success">Delivered</span>
              @else
              Canceled
              @endif
            </td>
            <td>
              <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="btn btn-xs btn-info mt-1 btn-tool" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Details">
								<i class="fa-solid fa-file-lines"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      @else
      <p class="text-center">No orders to show</p>
      @endif
    </div>
  </div>
</div>
