<?php

namespace App\Http\Controllers;

use App\Models\NotificationCheck;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $lastCheck = DB::table('notification_checks')->select('date')->where('user_id', Auth::id())->max('date');

        return response([
            'notifications' => Auth::user()->notifications()->offset($request->input('skip'))->limit(15)->get(),
            'unread_count' => Auth::user()->unreadNotifications()->count(),
            'uncheck_count' => $lastCheck
                ? Auth::user()->notifications()->whereNotNull('read_at')->where('created_at', '>', $lastCheck)
                : 0
        ]);
    }

    public function check($id)
    {
        $user = User::findOrFail($id);
        NotificationCheck::create([
            'date' => Carbon::now(),
            'user_id' => $user->id
        ]);
        return response(['message' => 'Success']);
    }
}
