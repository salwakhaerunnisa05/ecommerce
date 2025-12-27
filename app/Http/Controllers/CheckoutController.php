<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
{
    // 1. Ambil data cart user
    $cart = Cart::where('user_id', auth()->id())->first();
    
    // 2. Jika cart tidak ada, arahkan balik atau buat koleksi kosong agar tidak error
    if (!$cart) {
        return redirect()->route('catalog.index')->with('error', 'Keranjang belanja Anda kosong.');
    }

    // 3. Ambil items untuk menghitung subtotal
    $cart_items = $cart->items; 

    $subtotal = $cart_items->sum(function($item) {
        return ($item->product->price ?? 0) * $item->quantity;
    });

    $shippingCost = 15000;

    // PERBAIKAN: Kirim variabel 'cart' bukan 'cart->items'
    return view('checkout.index', compact('cart', 'cart_items', 'subtotal', 'shippingCost'));
}

    public function store(Request $request, OrderService $orderService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        try {
            $order = $orderService->createOrder(auth()->user(), $request->only(['name', 'phone', 'address']));

            // Redirect ke halaman pembayaran (akan dibuat besok)
            // Untuk sekarang, redirect ke detail order
            return redirect()->route('orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat! Silahkan lakukan pembayaran.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}