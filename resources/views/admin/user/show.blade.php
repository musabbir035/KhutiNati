@extends('admin.layout')
@section('title', $user->id == auth()->id() ? 'My Account' : $user->name . ' - User Details')
@section('main')
<div id="loadingSpinner" style="display: none">
  @livewire('loading')
</div>
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-12 col-md-6">
        <h4>
          @if($user->id == auth()->id())
          My Account
          @else
          User Details - {{ $user->name }}
          @endif
        </h4>
      </div>
      <div class="col-12 col-md-6 mt-2 mt-sm-0 text-md-end">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-1">User List</a>
        <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-warning mt-1">Edit</a>
        @if(auth()->user()->role < $user->role && auth()->id() != $user->id)
          @if($user->deleted_at)
          <a href="#" id="statusUpdateBtn" class="btn btn-success mt-1">
            Activate
          </a>
          @else
          <a href="#" id="statusUpdateBtn" class="btn btn-danger mt-1">
            Deactivate
          </a>
          @endif

          @endif
          @if(auth()->id() == $user->id)
          <a href="{{ route('change-password') }}" class="btn btn-success mt-1">Change Password</a>
          @endif
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Name</label>
      <span class="col-12 col-md-8 col-lg-10">{{ $user->name }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Mobile Number</label>
      <span class="col-12 col-md-8 col-lg-10">
        <a href="tel:{{ $user->mobile }}" class="td-none">{{ $user->mobile }}</a>
      </span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Email</label>
      <span class="col-12 col-md-8 col-lg-10">
        <a href="mailto:{{ $user->email }}" class="td-none">{{ $user->email }}</a>
      </span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Role</label>
      <span class="col-12 col-md-8 col-lg-10">
        @if($user->role == \App\Models\User::$SUPERADMIN)
        Super Admin
        @elseif($user->role == \App\Models\User::$ADMIN)
        Admin
        @elseif($user->role == \App\Models\User::$CUSTOMER)
        Customer
        @endif
      </span>
    </div>
    @if($user->role >= auth()->user()->role)
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Join Date</label>
      <span class="col-12 col-md-8 col-lg-10" id="avx">{{ $user->created_at->format('d-M-Y \a\t h:i a') }}</span>
    </div>
    <div class="details-item row">
      <label class="col-12 col-md-4 col-lg-2">Last update</label>
      <span class="col-12 col-md-8 col-lg-10">{{ $user->created_at->format('d-M-Y \a\t h:i a') }}</span>
    </div>
    @endif
  </div>
</div>
@endsection
@section('pageScripts')
<script>
  let statusUpdateBtn =  document.querySelector('#statusUpdateBtn');
  statusUpdateBtn?.addEventListener('click', () => {
    let loading = document.querySelector('#loadingSpinner');
    loading.style.display = 'block';
    axios.post('{{ route("admin.users.update-status", ["user" => $user->id]) }}').then(res => {
      loading.style.display = 'none';
      showFlashMessage(res.data.title, res.data.message, 'success');
      restyleBtn(statusUpdateBtn);
    }).catch(err => {
      loading.style.display = 'none';
      showFlashMessage("Failed", "Something went wrong.", 'danger');
    })
  })
  function restyleBtn (btn) {
    if(btn.classList.contains('btn-danger')) {
      btn.classList.remove('btn-danger');
      btn.classList.add('btn-success');
      btn.innerText = 'Activate';
    } else {
      btn.classList.remove('btn-success');
      btn.classList.add('btn-danger');
      btn.innerText = 'Deactivate';
    }
  }
</script>
@endsection