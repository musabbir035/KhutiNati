<?php

namespace App\Service;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderService
{
    public static function handleOrderProducts($orderProducts, $orderId)
    {
        $total = 0;
        foreach ($orderProducts as $orderProduct) {
            $product = Product::findOrFail($orderProduct['id']);
            $quantity = $orderProduct['quantity'];

            // If product is on discount calculate discounted price
            $productTotal = $product->discounted_price
                ? ($quantity * $product->discounted_price)
                : ($quantity * $product->price);
            $total += $productTotal;

            OrderProduct::create([
                'quantity' => $orderProduct['quantity'],
                'product_total' => $productTotal,
                'product_id' => $orderProduct['id'],
                'order_id' => $orderId
            ]);

            $product->inventory -= $orderProduct['quantity'];
            $product->save();
        }
        return $total;
    }

    public static function checkProductInventory($products)
    {
        $index = 0;
        $isSuccess = true;
        $inventory = 0;

        foreach ($products as $product) {
            $pro = Product::find($product['id'], ['inventory']);
            $inventory = $pro->inventory;
            if ($inventory < $product['quantity']) {
                $isSuccess = false;
                break;
            }
            $index++;
        }

        return [
            'isSuccess' => $isSuccess,
            'index' => $index,
            'inventory' => $inventory
        ];
    }

    public static function printInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);
    }
}
