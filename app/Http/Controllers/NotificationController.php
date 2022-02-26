<?php

namespace App\Http\Controllers;

use App\Models\NotificationCheck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $lastCheck = DB::table('notification_checks')->select('date')->where('user_id', Auth::id())->max('date');

        return response([
            'notifications' => Auth::user()->notifications()->offset($request->input('skip') ?? 0)->limit(15)->get(),
            'unread_count' => Auth::user()->unreadNotifications()->count(),
            'uncheck_count' => $lastCheck
                ? Auth::user()->notifications()->whereNull('read_at')->where('created_at', '>', $lastCheck)->count()
                : 0,
        ]);
    }

    public function test(Request $request)
    {
        $lastCheck = DB::table('notification_checks')->select('date')->where('user_id', 1)->max('date');

        $user = User::find(1);
        return response([
            'notifications' => $user->notifications()->offset($request->input('skip'))->limit(15)->get(),
            'unread_count' => $user->unreadNotifications()->count(),
            'uncheck_count' => $lastCheck
                ? $user->notifications()->whereNull('read_at')->where('created_at', '>', $lastCheck)->count()
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

    public function markAsRead(Request $request)
    {
        $notification = Auth::user()->notifications()->findOrFail($request->input('id'));
        $notification->read_at = Carbon::now();
        $notification->save();

        return response(['message' => 'Success']);
    }
}
