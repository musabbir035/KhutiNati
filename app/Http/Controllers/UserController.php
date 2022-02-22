<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        if (Auth::user()->role == 3) {
            return view('main.user.show', ['user' => Auth::user()]);
        }
        return view('admin.user.show', ['user' => Auth::user()]);
    }
}
