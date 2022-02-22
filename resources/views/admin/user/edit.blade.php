@extends('admin.layout')
@section('title', $user->name . (auth()->id() === $user->id ? ' - Edit Account' : ' - Edit User'))
@section('main')
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-md-6">
        <h4>{{(auth()->id() === $user->id ? 'Edit Account' : 'Edit User')}} - {{ $user->name }}</h4>
      </div>
      <div class="col-12 col-md-6 text-md-end">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">User List</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="POST">
      @csrf
      <input type="hidden" name="_method" value="PUT">
      <div class="row">
        @if(auth()->user()->role === 1)
        <div class="col-12 col-md-6 mb-2">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" placeholder="Enter a name"
            value="{{ old('name') ? old('name') : $user->name }}"
            class="form-control @error('name') is-invalid @enderror" required>
          @error('name')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        @endif
        @if(auth()->id() === $user->id)
        <div class="col-12 col-md-6 mb-2">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="Enter an email address"
            value="{{ old('email') ? old('email') : $user->email }}"
            class="form-control @error('email') is-invalid @enderror" required>
          @error('email')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12 col-md-6 mb-2">
          <label for="mobile">Mobile Number</label>
          <input type="text" name="mobile" id="mobile" placeholder="Enter a mobile number"
            value="{{ old('mobile') ? old('mobile') : $user->mobile }}"
            class="form-control @error('mobile') is-invalid @enderror" maxlength="11" required>
          @error('mobile')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        @endif
        <div class="col-12 mt-2">
          <button class="btn btn-primary btn-submit" type="submit">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection