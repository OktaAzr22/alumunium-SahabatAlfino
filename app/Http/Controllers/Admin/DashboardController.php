<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        // =========================
        // TOTAL DATA
        // =========================
        $totalProducts = Product::count();

        $totalMaterials = Material::count();

        $totalAccessories = Accessory::count();

        $totalOrders = Order::count();

        // =========================
        // ORDER TERBARU
        // =========================
        $latestOrders = Order::with([
                'user',
                'product',
                'status'
            ])
            ->latest()
            ->take(5)
            ->get();

        // =========================
        // RETURN VIEW
        // =========================
        return view(
            'admin.dashboard',
            compact(
                'totalProducts',
                'totalMaterials',
                'totalAccessories',
                'totalOrders',
                'latestOrders'
            )
        );
    }
}
