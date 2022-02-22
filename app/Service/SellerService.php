<?php

namespace App\Service;

use App\Models\Seller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SellerService
{
	public static function deleteSeller($id)
	{
		try {
			$seller = Seller::with('products')->findOrFail($id);
			if ($seller->products->count()) {
				return [
					'title' => 'Request denied',
					'message' => 'This seller has products. You need to delete those products first.',
					'code' => 405
				];
			}

			DB::transaction(function () use ($seller) {
				if ($seller->image && Storage::disk('public')->exists('images/sellers/' . $seller->image)) {
					Storage::disk('public')->delete('images/sellers/' . $seller->image);
				}

				$seller->delete();
			}, 3);

			return ['title' => 'Success', 'message' => 'Seller deleted.', 'code' => 200];
		} catch (Exception $e) {
			return ['title' => 'Error', 'message' => 'Something went wrong.', 'code' => 500];
		}
	}
}
