<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        return view('wishlist.index');
    }

    public function toggle(Product $product)
    {
        return response()->json([
            'success' => true,
            'message' => 'Wishlist toggled (dummy)',
        ]);
    }
}
