<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductReturn;

use Carbon\Carbon;


class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $orderTime = Carbon::now();
        $orderTime = $orderTime->format('d-m-y H:i');
        $order = Order::create([
            'saler' => $request['saler'],
            'total' => $request['total'],
            'modal' => $request['modal'],
            'profit' => $request['profit'],
            'tanggal' => $orderTime
        ]);
        return response($order, 200);
    }

    public function createOrderDetail(Request $request)
    {
        $orderDetail = OrderDetail::create([
            'order_id' => $request['order_id'], 
            'product_id' => $request['product_id'],
            'name' => $request['name'],
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
        $orders = Order::whereDate('created_at', '>=', date('Y-m-d'))
        ->orderByDesc('id')->get();
  
        //echo Carbon::now();
        // five days ago
        //$orders = Order::whereDate('created_at', '>=', date('Y-m-d', strtotime("-5 day")) )->get();
        return response($orders, 200);
    }

    public function getOrderDetail(Request $request, $id )
    {
        $orderDetail = OrderDetail::where('order_id', '=', $id)->get();

        return $orderDetail;
    }

    public function sumProfit(Request $request)
    {
        $total = Order::selectRaw('IFNULL(SUM(profit), 0) as total')
        ->whereDate('created_at', '>=', date('Y-m-d'))
        ->get();

        return response($total, 200);
    }

    public function setReturnProduct(Request $request)
    {
        $returnTime = Carbon::now();
        $productReturn = ProductReturn::create([
            'order_id' => $request['order_id'],
            'product_id' => $request['product_id'],
            'model' => $request['model'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'subtotal' => ($request['quantity'] * $request['price']),
            'reason' => $request['reason'],
            'tanggal'=> $returnTime
        ]);

        $updateOrderDetail = OrderDetail::where('order_id', $request['order_id'])
                            ->where('product_id', $request['product_id'])
                            ->update(['return' => 1, 'return_quantity' => $request['quantity']]);
        
        return response($updateOrderDetail, 200);
    }
}
