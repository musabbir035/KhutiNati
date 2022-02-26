<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderStatusRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderPlacedNotification;
use App\Service\OrderService;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function create(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $orderProducts = $request->input('orderProducts');
            $inventoryValidation = OrderService::checkProductInventory($orderProducts);
            if (!$inventoryValidation['isSuccess']) {
                $msg = 'This product is out of stock.';
                if ($inventoryValidation['inventory'] > 0) {
                    $msg = 'We only have ' . $inventoryValidation['inventory'] . ' units of this product in stock.';
                }
                return response([
                    'message' => 'Inventory validation failed.',
                    'errors' => [
                        'orderProducts.' . $inventoryValidation['index'] => $msg
                    ]
                ], 400);
            }

            $userId = null;
            if (Auth::check()) {
                $userId = Auth::id();
            }

            $address = $request->has('address_id')
                ? Address::find($request->input('address_id'))
                : Address::create([
                    'name' => $request->input('name'),
                    'mobile' => $request->input('mobile'),
                    'address' => $request->input('address'),
                    'upazila_id' => $request->input('upazila_id'),
                    'district_id' => $request->input('district_id'),
                    'division_id' => $request->input('division_id'),
                    'user_id' => $userId
                ]);

            $order = Order::create([
                'status' => Order::$PROCESSING,
                'total' => 0,
                'date' => Carbon::now(),
                'address_id' => $address->id,
                'user_id' => $userId
            ]);

            $order->total = OrderService::handleOrderProducts($orderProducts, $order->id);
            $order->save();

            $admins = User::whereIn('role', [1, 2])->get();
            Notification::send($admins, new OrderPlacedNotification($address->name, $order));
            DB::commit();

            return response([
                'message' => 'Order placed',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateOrderStatus(OrderStatusRequest $request)
    {
        DB::beginTransaction();
        try {
            $status = $request->input('status');
            $order = Order::find($request->input('order_id'));
            $order->status = $status;
            $order->save();

            $msg = 'Order status updated to: Delivered.';

            if ($status === Order::$CANCELED) {
                $orderProducts = OrderProduct::where('order_id', $order->id);
                foreach ($orderProducts as $orderProduct) {
                    $product = Product::find($orderProduct->product_id);
                    $product->inventory += $orderProduct->quantity;
                    $product->save();
                }
                $msg = 'Order status updated to: Canceled.';
            }

            DB::commit();

            if ($status === Order::$AWAITING_CONFIRMATION) {
                $msg = 'Order status updated to: Awaiting confirmation.';
            } else if ($status === Order::$PROCESSING) {
                $msg = 'Order status updated to: Processing.';
            }

            return response([
                'title' => 'Success',
                'message' => $msg,
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response([
                'message' => 'Something went wrong.',
            ], 500);
        }
    }
}
