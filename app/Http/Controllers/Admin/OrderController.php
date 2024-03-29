<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Service\NotificationService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.index', ['orders' => Order::paginate(15)]);
    }

    public function show(Request $request, Order $order)
    {
        if ($request->has('notif_id')) {
            NotificationService::markAsRead($request->input('notif_id'));
        }
        return view('admin.order.show', [
            'order' => $order
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return response([
            'title' => 'Success',
            'message' => 'Order status updated.',
            'status' => $order->status
        ], 200);
    }
}
