<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
        ]);
        return response()->json($cart);
    }

    public function getCart()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return CartResource::collection($cart);
    }

    public function removeFromCart($id)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $id)->first();
        $cart->delete();
        return response()->json(['message' => 'Cart item removed successfully']);
    }
}
