<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Service\UserService;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $role;

    public function render()
    {
        $users = User::withFilters($this->search, $this->role)->paginate(15);

        return view('livewire.admin.user-list', [
            'users' => $users
        ])->extends('admin.layout')->section('main');
    }

    public function updateList()
    {
        $this->resetPage();
    }

    public function toggleUserStatus($id)
    {
        $updateStatus = UserService::updateStatus($id);
        $this->emit('userStatusUpdated', $updateStatus['title'], $updateStatus['message']);
    }
}
