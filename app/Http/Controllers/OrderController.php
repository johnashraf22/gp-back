<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_price' => $request->total_price ?? 0,
            'status' => 'pending',
            'payment_method' => 'cash',
            'address' => $request->address ?? auth()->user()->address,
            'phone' => $request->phone ?? auth()->user()->phone,
            'name' => $request->name ?? auth()->user()->name,
        ]);
        return response()->json($order);
    }
}
