@extends('admin.layout')
@section('title', 'Change Password')
@section('main')
<div class="card">
  <div class="card-header">
    <h4>Change Password</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('change-password.submit') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-12 col-md-6 mb-2">
          <label for="new_pass">New Password</label>
          <input type="password" name="new_pass" id="new_pass" placeholder="Enter new password"
            class="form-control @error('new_pass') is-invalid @enderror" required>
          @error('new_pass')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="new_pass_confirm">Confirm New Password</label>
          <input type="password" name="new_pass_confirm" id="new_pass_confirm" placeholder="Enter new password again"
            class="form-control @error('new_pass_confirm') is-invalid @enderror" required>
          @error('new_pass_confirm')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 col-md-6 mb-2">
          <label for="current_pass">Current Password</label>
          <input type="password" name="current_pass" id="current_pass" placeholder="Enter current password"
            class="form-control @error('current_pass') is-invalid @enderror" required>
          @error('current_pass')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 mt-2">
          <button class="btn btn-primary btn-submit" type="submit">Change Password</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
