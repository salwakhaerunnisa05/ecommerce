<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ==============================
        // STATISTIK UTAMA
        // ==============================
        $totalUsers   = User::count();
        $totalProducts = Product::count();
        $totalOrders  = Order::count();

        // Total pendapatan (order selesai / paid)
        $totalRevenue = Order::whereIn('status', ['paid', 'completed'])
            ->sum('total_price');

        // ==============================
        // ORDER TERBARU
        // ==============================
        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // ==============================
        // STATISTIK ORDER BERDASARKAN STATUS
        // ==============================
        $orderStatusStats = Order::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // ==============================
        // PENJUALAN PER BULAN (12 BULAN)
        // ==============================
        $monthlySales = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total')
            )
            ->whereIn('status', ['paid', 'completed'])
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'latestOrders',
            'orderStatusStats',
            'monthlySales'
        ));
    }
}
