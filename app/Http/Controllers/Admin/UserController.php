<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(RegistrationRequest $request)
    {
        User::create($request->safe()->except(['email', 'password']) + [
            'email' => strtolower($request->input('email')),
            'password' => Hash::make($request->input('password')),
            'role' => 2
        ]);
        return redirect()->route('admin.users.index')->with([
            'title' => 'Success',
            'message' => 'User added',
            'code' => 200
        ]);
    }

    public function show($id)
    {
        return view('admin.user.show', ['user' => User::withTrashed()->findOrFail($id)]);
    }

    public function edit($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ((Auth::user()->role == User::$SUPERADMIN && $user->role != User::$CUSTOMER) || Auth::id() == $id) {
            return view('admin.user.edit', ['user' => $user]);
        } else {
            return redirect()->route('admin.users.index')->with([
                'title' => 'Permission denied',
                'message' => 'Cannot edit customer account.',
                'code' => '403'
            ]);
        }
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->safe()->except(['email']) + [
            'email' => $request->has('email') ? strtolower($request->input('email')) : $user->email
        ]);

        return redirect()->route('admin.users.index')->with([
            'title' => 'Success',
            'message' => 'User updated',
            'code' => '200'
        ]);
    }

    public function updateStatus($id)
    {
        return UserService::updateStatus($id);
    }
}
