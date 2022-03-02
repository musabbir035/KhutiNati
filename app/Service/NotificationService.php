<?php

namespace App\Service;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NotificationService
{
    public static function markAsRead($id)
    {
        Auth::user()->notifications()->findOrFail($id)->markAsRead();
    }
}
