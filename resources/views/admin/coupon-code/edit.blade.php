@extends('admin.layout')
@section('title', 'Edit Coupon Code')
@section('main')
<nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('admin.coupons.index') }}">Coupon Codes</a>
    </li>
    <li class="breadcrumb-item">{{ $coupon->code }}</li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>

<div class="card mt-4">
  <div class="card-body">
    <form action="{{ route('admin.coupons.update', ['coupon' => $coupon->id]) }}" method="POST">
      @csrf
      <input type="hidden" name="_method" value="PUT">
      <div class="row">
        <div class="col-12 col-md-6 mb-3">
          <label for="code">Code</label>
          <input type="text" name="code" id="code" placeholder="Enter code" value="{{ old('code') ?: $coupon->code }}"
            class="form-control @error('code') is-invalid @enderror" required>
          @error('code')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="discount_percentage">Discount Percentage</label>
          <input type="number" class="form-control" id="discount_percentage" name="discount_percentage"
            placeholder="Enter discount percentage" aria-label="Disount Percentage"
            value="{{ old('discount_percentage') ?: $coupon->discount_percentage }}">
          @error('discount_percentage')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="maximum_discount">Maximum Discount (optional)</label>
          <input type="number" name="maximum_discount" id="maximum_discount" placeholder="Enter maximum discount"
            value="{{ old('maximum_discount') ?: $coupon->maximum_discount }}" class="form-control @error('maximum_discount') is-invalid @enderror">
          @error('maximum_discount')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="validity_start">Validity Start</label>
          <input type="datetime-local" name="validity_start" id="validity_start" placeholder="Enter validity start date & time"
            value="{{ old('validity_start') ?: date('Y-m-d\TH:i', strtotime($coupon->validity_start)) }}" class="form-control @error('validity_start') is-invalid @enderror">
          @error('validity_start')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-3">
          <label for="validity_end">Validity End</label>
          <input type="datetime-local" name="validity_end" id="validity_end" placeholder="Enter validity end date & time"
            value="{{ old('validity_end') ?: date('Y-m-d\TH:i', strtotime($coupon->validity_end)) }}" class="form-control @error('validity_end') is-invalid @enderror">
          @error('validity_end')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        @if (session('submit_error'))
        <p class="text-danger">{{ session('submit_error') }}</p>
        @endif

        <div class="col-12 mt-2">
          <button class="btn btn-primary btn-submit" type="submit">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('pageScripts')
<script>
function abc(e) {
alert(e.value)
}
</script>
@endsection
