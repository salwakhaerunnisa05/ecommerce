<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik user yang sedang login.
     */
    public function index()
    {
        // PENTING: Jangan gunakan Order::all() !
        // Kita hanya mengambil order milik user yg sedang login menggunakan relasi hasMany.
        // auth()->user()->orders() akan otomatis memfilter: WHERE user_id = current_user_id
        $orders = auth()->user()->orders()
            ->with(['items.product']) // Eager Load nested: Order -> OrderItems -> Product
            ->latest() // Urutkan dari pesanan terbaru
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // 1. Authorize (Security Check)
        // User A TIDAK BOLEH melihat pesanan User B.
        // Kita cek apakah ID pemilik order sama dengan ID user yang login.
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // 2. Load relasi detail
        // Kita butuh data items dan gambar produknya untuk ditampilkan di invoice view.
        $order->load(['items.product', 'items.product.primaryImage']);

        return view('orders.show', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran sukses.
     */
    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.success', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran pending.
     */
    public function pending(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.pending', compact('order'));
    }
}
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
