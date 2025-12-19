<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar order milik user
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Tampilkan detail satu order
     */
    public function show(Order $order)
    {
        // Security: pastikan order milik user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        // Load relasi items & product
        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    /**
     * Simpan order dari cart (checkout sederhana)
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->back()
                ->with('error', 'Keranjang masih kosong');
        }

        DB::beginTransaction();

        try {
            // Hitung total
            $total = $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            // Buat order
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            // Simpan order items
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            // Kosongkan cart
            $cart->items()->delete();

            DB::commit();

            return redirect()
                ->route('orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat membuat pesanan');
        }
    }
}
