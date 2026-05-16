<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(
        Request $request,
        Order $order
    ) { 
        // =========================
        // VALIDASI OWNER
        // =========================
        if ($order->user_id != Auth::id()) {
            abort(403);
        }
        // =========================
        // VALIDASI
        // =========================
        $request->validate([

            'payment_type'
                => 'required|in:dp,lunas',

            'payment_proof'
                => 'required|image|max:2048',
        ]);
        // =========================
        // HITUNG NOMINAL
        // =========================
        if ($request->payment_type == 'dp') {

            $amount = $order->dp_amount;

        } else {

            $amount = $order->final_price;
        }
        // =========================
        // UPLOAD BUKTI
        // =========================
        $proof = $request
            ->file('payment_proof')
            ->store(
                'payments',
                'public'
            );
            // =========================
        // CREATE PAYMENT
        // =========================
        Payment::create([

            'order_id'
                => $order->id,

            'payment_type'
                => $request->payment_type,

            'amount'
                => $amount,

            'payment_proof'
                => $proof,

            'status'
                => 'pending',
        ]);
        // =========================
        // STATUS MENUNGGU KONFIRMASI
        // =========================
        $waitingPaymentStatus = OrderStatus::where(
            'slug',
            'menunggu_konfirmasi_pembayaran'
        )->first();

        if ($waitingPaymentStatus) {

            $order->update([
                'status_id' => $waitingPaymentStatus->id
            ]);
        }
        return back()->with(
            'success',
            'Pembayaran berhasil dikirim'
        );
         }
}
