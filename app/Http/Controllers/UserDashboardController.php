<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{

    public function index()
    {
    
        $totalOrders = Order::where(
            'user_id',
            Auth::id()
        )->count();

        $waitingPayment = Order::where(
            'user_id',
            Auth::id()
        )
        ->where(
            'status_id',
            1
        )
        ->count();

        $completedOrders = Order::where(
            'user_id',
            Auth::id()
        )
        ->where(
            'status_id',
            5
        )
        ->count();

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

        $paymentOrders = Order::with([
            'product',
            'status',
            'payments'
        ])
        ->where(
            'user_id',
            Auth::id()
        )
        ->whereHas('status', function ($query) {

            $query->whereIn(
                'name',
                [
                    'Pending',
                    'Dicek Admin',
                    'Menunggu Pembayaran',
                ]
            );

        })
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