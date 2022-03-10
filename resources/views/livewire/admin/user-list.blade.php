@section('title', 'Users')
<div>
	<div wire:loading>
		@livewire('loading')
	</div>
	<nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Users</li>
      <li class="breadcrumb-item ms-auto" style="--bs-breadcrumb-divider: '';">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">Add New</a>
      </li>
    </ol>
  </nav>

	<div class="card mt-4">
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-md-6 col-lg-4 mb-3">
					<input type="text" id="search" placeholder="Search users..." class="form-control input-slim"
						wire:model="search" wire:change="updateList">
				</div>
				<div class="col-12 col-md-6 col-lg-4 mb-3">
          <div class="input-group">
            <label class="input-group-text input-slim" for="role">Showing</label>
            <select id="role" class="form-select input-slim" wire:model="role" wire:change="updateList">
              <option value="">All users</option>
              <option value="1" @if(app('request')->input('role') == 1) selected @endif>
                Super Admins
              </option>
							<option value="2" @if(app('request')->input('role') == 2) selected @endif>
                Admins
              </option>
							<option value="3" @if(app('request')->input('role') == 3) selected @endif>
                Customers
              </option>
            </select>
          </div>
        </div>
			</div>
			@if($users->count())
			<div class="table-responsive">
				<table class="table">
					<tr class="table-primary">
						<th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Role</th>
						<th>Join Date</th>
						<th>Actions</th>
					</tr>
					@foreach ($users as $user)
					<tr class="@if($user->deleted_at) table-danger @endif">
						<td>{{ $user->name }}</td>
						<td><a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a></td>
						<td><a href="tel:{{ $user->mobile }}" class="text-decoration-none">{{ $user->mobile }}</a></td>
						<td>
							@if($user->role === \App\Models\User::$SUPERADMIN)
							Super Admin
							@elseif ($user->role === \App\Models\User::$ADMIN)
							Admin
							@elseif ($user->role === \App\Models\User::$CUSTOMER)
							Customer
							@endif
						</td>
						<td>{{ date('d-M-Y h:i a', strtotime($user->created_at)) }}</td>
						<td>
							<a href="{{ route('admin.users.show', ['user' => $user->id]) }}"
								class="btn btn-info btn-xs btn-tool mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Details">
								<i class="fa-solid fa-file-lines"></i>
							</a>
							@if((auth()->user()->role == \App\Models\User::$SUPERADMIN && $user->role != \App\Models\User::$CUSTOMER) || auth()->id() == $user->id )
							<a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
								class="btn btn-warning btn-xs btn-tool mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
								title="Edit">
								<i class="fa-solid fa-pen-to-square"></i>
							</a>
							@endif
							@if(auth()->user()->role < $user->role && auth()->id() != $user->id)
							@if($user->deleted_at)
							<a href="#" class="btn btn-success btn-xs mt-1"
								wire:click="toggleUserStatus({{ $user->id }})">Activate</a>
							@else
							<a href="#" class="btn btn-danger btn-xs mt-1"
								wire:click="toggleUserStatus({{ $user->id }})">Deactivate</a>
							@endif
							@endif
						</td>
					</tr>
					@endforeach
				</table>
			</div>
			@else
			<p class="text-center">No users to show</p>
			@endif
		</div>
	</div>
</div>
@section('livewireViewScripts')
<script>
	window.livewire.on('userStatusUpdated', (title, msg) => {
		showFlashMessage(title, msg, 'success');
	})
</script>
@endsection