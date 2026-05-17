<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    // =========================
    // USER DASHBOARD
    // =========================
    public function index()
    {
        // =========================
        // TOTAL PESANAN
        // =========================
        $totalOrders = Order::where(
            'user_id',
            Auth::id()
        )->count();

        // =========================
        // MENUNGGU PEMBAYARAN
        // status_id = 1
        // =========================
        $waitingPayment = Order::where(
            'user_id',
            Auth::id()
        )
        ->where(
            'status_id',
            1
        )
        ->count();

        // =========================
        // PESANAN SELESAI
        // status_id = 5
        // =========================
        $completedOrders = Order::where(
            'user_id',
            Auth::id()
        )
        ->where(
            'status_id',
            5
        )
        ->count();

        // =========================
        // ORDER TERBARU
        // =========================
        $latestOrders = Order::with([
            'product',
            'status'
        ])
        ->where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->take(5)
        ->get();

        // =========================
// PESANAN MENUNGGU PEMBAYARAN
// =========================
$paymentOrders = Order::with([
    'product',
    'status',
    'payments'
])
->where(
    'user_id',
    Auth::id()
)
->whereIn(
    'status_id',
    [
        1, // belum bayar
        2, // DP
    ]
)
->latest()
->get();

        return view(
            'user.dashboard',
            compact(
                'totalOrders',
                'waitingPayment',
                'completedOrders',
                'latestOrders',
                'paymentOrders'
            )
        );
    }
}