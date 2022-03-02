@extends('admin.layout')
@section('title', 'Order Details')
@section('main')
<div id="loadingSpinner" style="display: none">
  @livewire('loading')
</div>
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h4>
          Order Details - #{{ $order->id }}
          @if($order->status == \App\Models\Order::$AWAITING_CONFIRMATION)
          <span class="badge bg-danger" id="statusText">Awaiting Confirmation</span>
          @elseif($order->status == \App\Models\Order::$PROCESSING)
          <span class="badge bg-warning" id="statusText">Processing</span>
          @elseif($order->status == \App\Models\Order::$DELIVERED)
          <span class="badge bg-success" id="statusText">Delivered</span>
          @else
          <span class="badge bg-secondary" id="statusText">Canceled</span>
          @endif
        </h4>
      </div>
      <div class="col-12 col-sm-6 mt-2 mt-sm-0 text-sm-end">
        <a href="#" id="invoiceBtn" class="btn btn-primary">Print Invoice</a>
        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateStatusModal">Update Status</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <span class="col-12 col-md-4 col-lg-2 fw-bold">Name</span>
      <span class="col-12 col-md-8 col-lg-10">
        @if($order->address->user_id)
        <a href="{{route('admin.users.show', ['user' => $order->address->user_id])}}">{{ $order->address->name }}</a>
        @else
        {{ $order->address->name }}
        @endif
      </span>

      <label class="col-12 col-md-4 col-lg-2 fw-bold">Mobile</label>
      <span class="col-12 col-md-8 col-lg-10">
        <a class="td-none" href="tel:{{ $order->address->mobile }}">{{ $order->address->mobile }}</a>
      </span>

      <label class="col-12 col-md-4 col-lg-2 fw-bold">Address</label>
      <span class="col-12 col-md-8 col-lg-10">
        {{ $order->address->address }},
        {{ $order->address->upazila->name }},
        {{ $order->address->district->name }},
        {{ $order->address->division->name }}
      </span>

      <label class="col-12 col-md-4 col-lg-2 fw-bold">Date</label>
      <span class="col-12 col-md-8 col-lg-10">
        {{ $order->date->format('d-M-Y \a\t h:i a') }} (<span id="dateTimeAgo"></span>)
      </span>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <tr class="table-info">
          <th>Product</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
        </tr>
        @foreach ($order->orderProducts as $orderProduct)
        <tr>
          <td>{{ $orderProduct->product->name }}</td>
          <td>{{ $orderProduct->quantity }}</td>
          @if($orderProduct->product->discounted_price)
          <td>৳ {{ $orderProduct->product->discounted_price }}</td>
          <td>৳ {{ $orderProduct->quantity * $orderProduct->product->discounted_price }}</td>
          @else
          <td>৳ {{ $orderProduct->product->price }}</td>
          <td>৳ {{ $orderProduct->quantity * $orderProduct->product->price }}</td>
          @endif
        </tr>
        @endforeach
        <tr>
          <th colspan="3">Total</th>
          <th>৳ {{ $order->total }}</th>
        </tr>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateStatusModalLabel">Update Order Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="statusSelect" class="form-select">
          <option value="">Select Status</option>
          <option value="1" @if($order->status == 1) selected @endif>Awaiting Confirmation</option>
          <option value="2" @if($order->status == 2) selected @endif>Processing</option>
          <option value="3" @if($order->status == 3) selected @endif>Delivered</option>
          <option value="4" @if($order->status == 4) selected @endif>Canceled</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="statusUpdateBtn">Update</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('pageScripts')
<script>
  document.querySelector('#dateTimeAgo').innerText = formatDateAsTimeAgo('{{ $order->date }}')

  const statusUpdateBtn = document.querySelector('#statusUpdateBtn')
  statusUpdateBtn.addEventListener('click', () => {
    let status = document.querySelector('#statusSelect').value
    const loading = document.querySelector('#loadingSpinner');
    const statusTextEl = document.querySelector('#statusText');
    const modalEl = document.querySelector('#updateStatusModal');
    const modal = bootstrap.Modal.getInstance(modalEl);

    axios.post('{{ route("admin.orders.update-status", ["order" => $order->id]) }}', { status })
      .then(res => {
        loading.style.display = 'none';
        showFlashMessage(res.data.title, res.data.message, 'success');
        restyleStatusText(statusTextEl, res.data.status)
        modal.hide();
      }).catch(err => {
        loading.style.display = 'none';
        showFlashMessage("Failed", "Something went wrong.", 'danger');
      });
  })

  function restyleStatusText (el, status) {
    let className = 'bg-secondary';
    let text = 'Canceled';

    if(status == 1) {
      className = 'bg-danger';
      text = 'Awaiting Confirmation';
    }
    if(status == 2) {
      className = 'bg-warning';
      text = 'Processing';
    }
    if(status == 3) {
      className = 'bg-success';
      text = 'Delivered';
    }

    el.innerText = text;
    el.classList.remove('bg-danger', 'bg-warning', 'bg-success', 'bg-secondary');
    el.classList.add(className);
  }
</script>
@endsection