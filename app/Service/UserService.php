<?php

namespace App\Service;

use App\Models\User;

class UserService
{
	public static function updateStatus($id)
	{
		$user = User::withTrashed()->findOrFail($id);
		if ($user->deleted_at) {
			$user->restore();
			$msg = 'User activated.';
		} else {
			$user->delete();
			$msg = 'User deactivated.';
		}

		return response([
			'title' => 'Success',
			'message' => $msg,
		], 200);
	}
}
