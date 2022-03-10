@extends('layout')
@section('title', 'Checkout')
@section('main')
<div class="container">
  <div class="card">
    <div class="card-body">
      <h5>Delivery Address</h5>
      <form action="{{ route('orders.address.store') }}" class="mt-4" method="POST">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <label for="division_id">Division*</label>
            <select id="division_id" name="division_id" class="form-select mt-1 @error('division_id') is-invalid @enderror">
              <option value="">Select your division</option>
              @foreach ($divisions as $div)
                <option value="{{ $div->id }}" @if(old('division_id') == $div->id) selected @endif>{{ $div->name }}</option>
              @endforeach
            </select>
            @error('division_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="district_id" class="mt-3">District*</label>
            <select id="district_id" name="district_id" class="form-select mt-1 @error('district_id') is-invalid @enderror" disabled>
              <option value="">Select your district</option>
            </select>
            @error('district_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="area_id" class="mt-3">Area*</label>
            <select id="area_id" name="area_id" class="form-select mt-1 @error('area_id') is-invalid @enderror" disabled>
              <option value="">Select your area</option>
            </select>
            @error('area_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="address" class="mt-3">Address*</label>
            <input type="text" id="address" name="address" placeholder="Enter your address"
              class="form-control mt-1 @error('address') is-invalid @enderror" value="{{ old('address') }}">
            @error('address')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12 col-md-6">
            <label for="name">Full Name*</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name"
              class="form-control mt-1 @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="mobile" class="mt-3">Mobile Number*</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter your mobile number"
              class="form-control mt-1 @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}">
            @error('mobile')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="email" class="mt-3">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address (optional)"
              class="form-control mt-1 @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 mt-4">
            <button type="submit" class="btn btn-primary">Proceed to Pay</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('pageScripts')
<script>
  const divisionSelect = document.querySelector('#division_id');
  const districtSelect = document.querySelector('#district_id');
  const areaSelect = document.querySelector('#area_id');

  divisionSelect.addEventListener('change', (e) => {
    const id = e.target.value;
    showFullPageLoading()
    axios.get(`/api/districts?division_id=${id}`).then(res => {
      districtSelect.innerHTML = '<option>Select your district</option>';
      res.data.districts.forEach(element => {
        if(!res.data.districts || res.data.districts.length <= 0) {
          districtSelect.disabled = true;
          return;
        }
        let opt = document.createElement('option')
        opt.value = element.id;
        opt.innerText = element.name;
        districtSelect.appendChild(opt);
        districtSelect.disabled = false;
      });
    }).finally(() => {
      hideFullPageLoading()
    })
  })

  districtSelect.addEventListener('change', (e) => {
    const id = e.target.value;
    showFullPageLoading()
    axios.get(`/api/areas?district_id=${id}`).then(res => {
      areaSelect.innerHTML = '<option>Select your area</option>';
      res.data.areas.forEach(element => {
        if(!res.data.areas || res.data.areas.length <= 0) {
          areaSelect.disabled = true;
          return;
        }
        let opt = document.createElement('option')
        opt.value = element.id;
        opt.innerText = element.name;
        areaSelect.appendChild(opt);
        areaSelect.disabled = false;
      });
    }).finally(() => {
      hideFullPageLoading()
    })
  })
</script>
@endsection
