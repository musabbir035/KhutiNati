<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Notifications\UserRegisteredNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->has('remember');

        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        if (Auth::attempt([$field => strtolower($username), 'password' => $password], $remember)) {
            $request->session()->regenerate();
            if (in_array(Auth::user()->role, [1, 2])) {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/');
        }

        $msg = $field === 'email' ? 'Email and password do not match.' : 'Mobile number and password do not match.';
        return back()->withInput($request->input())->with('error', $msg);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->validated() + [
                'role' => 3
            ]);
            Auth::login($user);
            $request->session()->regenerate();

            $admins = User::whereIn('role', [1, 2])->get();
            Notification::send($admins, new UserRegisteredNotification($user->name, $user->id));

            DB::commit();
            return redirect('/');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with([
                'submit_error' => 'Something went wrong.'
            ]);
        }
    }

    public function showChangePasswordForm()
    {
        if (in_array(Auth::user()->role, [User::$SUPERADMIN, User::$ADMIN])) {
            return view('admin.user.change-password');
        } else {
            return view('auth.change-password');
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->input('new_pass'));
        $user->save();

        $response = [
            'title' => 'Success',
            'message' => 'Password changed.',
            'code' => 200
        ];
        if ($user->role === User::$CUSTOMER) {
            return redirect()->route('user.account')->with($response);
        }
        return redirect()->route('admin.account')->with($response);
    }

    public function showPasswordRecoveryForm()
    {
        return view('auth.password-recovery');
    }

    public function passwordRecovery()
    {
        return redirect()->route('password.recovery.confirm.form');
    }

    public function showPasswordRecoveryConfirmForm()
    {
        return view('auth.password-recovery-confirm');
    }
}
