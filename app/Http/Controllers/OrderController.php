<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return response()->json($orders);
    }

    public function adminIndex()
    {
        $orders = Order::with('items')->paginate(10);
        return OrderResource::collection($orders);
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_price' => $request->total_price ?? 0,
            'status' => 'pending',
            'payment_method' => 'cash',
            'address' => ($request->address ?? auth()->user()->address) ?? "test address",
            'phone' => ($request->phone ?? auth()->user()->phone) ?? "test phone",
            'name' => ($request->name ?? auth()->user()->name) ?? "test name",
        ]);
        foreach($request->products as $product){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'price' => $product['price'],
            ]);
        }
        return response()->json($order);
    }
    
}
