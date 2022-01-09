<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $order = Order::create([
            'saler' => $request['saler'],
            'total' => $request['total'],
            'modal' => $request['modal'],
            'profit' => $request['profit']
        ]);
        return response($order, 200);
    }

    public function createOrderDetail(Request $request)
    {
        $orderDetail = OrderDetail::create([
            'order_id' => $request['order_id'], 
            'product_id' => $request['product_id'],
            'model' => $request['model'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'subtotal' => $request['subtotal']
        ]);
        return response($orderDetail, 200);
    }

    public function updateProductQty(Request $request, $id)
    {
        $quantity = (int)$request['quantity'];
        $product = Product::find($id);
        $product->decrement('quantity_shop', $quantity);
        $product->sold = ($product->sold + $quantity);
        $product->save();
        return $quantity;
    }

    public function getOrders(Request $request) 
    {
        // today
        $orders = Order::whereDate('created_at', '>=', date('Y-m-d'))->get();
  
        // five days ago
        //$orders = Order::whereDate('created_at', '>=', date('Y-m-d', strtotime("-5 day")) )->get();
        return response($orders, 200);
    }
}
