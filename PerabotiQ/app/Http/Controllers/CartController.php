<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
        }

        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('keranjang', compact('cartItems'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk menambahkan barang ke keranjang.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $productId = $request->product_id;
        $qty = $request->quantity ?? 1;
        $userId = Auth::id();

        // Check if item exists in cart
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $qty;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $qty
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id == Auth::id()) {
            $cart->delete();
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
