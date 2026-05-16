<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;

class OrderAdminController extends Controller
{
    // =========================
    // LIST SEMUA ORDER
    // =========================
    public function index()
    {
        $orders = Order::with([
            'user',
            'detail.product',
            'status'
        ])
        ->latest()
        ->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    // =========================
    // DETAIL ORDER
    // =========================
    public function show(Order $order)
    {
        // =========================
        // AUTO UBAH STATUS
        // pending -> menunggu konfirmasi
        // =========================
        $waitingConfirmationId = OrderStatus::where(
            'slug',
            'menunggu_konfirmasi'
        )->value('id');

        if (
            $order->status &&
            $order->status->slug === 'pending'
        ) {

            $order->update([
                'status_id' => $waitingConfirmationId
            ]);
        }

        // =========================
        // LOAD RELATION
        // =========================
        $order->load([
            'user',
            'product',
            'detail.material',
            'detail.accessories',
            'payments',
            'status',
        ]);

        // =========================
        // HITUNG TOTAL ACCESSORIES
        // =========================
        $accessoriesTotal = 0;

        if ($order->detail) {

            foreach (
                $order->detail->accessories
                as $accessory
            ) {

                $accessoriesTotal +=
                    $accessory->pivot->subtotal;
            }
        }

        // =========================
        // ESTIMASI SISTEM
        // =========================
        $estimatedPrice =
            $order->detail
            ? $order->detail->subtotal + $accessoriesTotal
            : 0;

        // =========================
        // AMBIL STATUS
        // =========================
        $statuses = OrderStatus::all();

        return view(
            'admin.orders.show',
            compact(
                'order',
                'statuses',
                'estimatedPrice',
                'accessoriesTotal'
            )
        );
    }

    // =========================
    // UPDATE ORDER
    // =========================
    public function update(
        Request $request,
        Order $order
    ) {

        $request->validate([

            'status_id'
                => 'required|exists:order_statuses,id',

            'other_cost'
                => 'nullable|numeric|min:0',

            'dp_percent'
                => 'nullable|numeric|min:0|max:100',

            'admin_notes'
                => 'nullable|string',
        ]);

        // =========================
        // HITUNG TOTAL ACCESSORIES
        // =========================
        $accessoriesTotal = 0;

        if ($order->detail) {

            foreach (
                $order->detail->accessories
                as $accessory
            ) {

                $accessoriesTotal +=
                    $accessory->pivot->subtotal;
            }
        }

        // =========================
        // TOTAL DASAR
        // =========================
        $baseTotal =
            $order->detail
            ? $order->detail->subtotal + $accessoriesTotal
            : 0;

        // =========================
        // BIAYA LAIN LAIN
        // =========================
        $otherCost =
            $request->other_cost ?? 0;

        // =========================
        // FINAL PRICE
        // =========================
        $finalPrice =
            $baseTotal + $otherCost;

        // =========================
        // DP PERCENT
        // =========================
        $dpPercent =
            $request->dp_percent ?? 0;

        // =========================
        // HITUNG NOMINAL DP
        // =========================
        $dpAmount =
            ($finalPrice * $dpPercent) / 100;

        // =========================
        // DATA UPDATE
        // =========================
        $data = [

            'status_id'
                => $request->status_id,

            'final_price'
                => round(
                    $finalPrice,
                    2
                ),

            'other_cost'
                => round(
                    $otherCost,
                    2
                ),

            'dp_percent'
                => round(
                    $dpPercent,
                    2
                ),

            'dp_amount'
                => round(
                    $dpAmount,
                    2
                ),

            'admin_notes'
                => $request->admin_notes,
        ];

        // =========================
        // STATUS SELESAI
        // =========================
        $statusSelesai = OrderStatus::where(
            'slug',
            'selesai'
        )->first();

        if (
            $statusSelesai &&
            $request->status_id == $statusSelesai->id
        ) {

            $data['finished_at'] = now();
        }

        // =========================
// CEK STATUS SELESAI
// =========================
$statusSelesai = OrderStatus::where(
    'slug',
    'selesai'
)->first();

$statusMenungguPelunasan = OrderStatus::where(
    'slug',
    'menunggu_pelunasan'
)->first();

// pembayaran terakhir
$lastPayment = $order
    ->payments()
    ->latest()
    ->first();

if (
    $statusSelesai &&
    $request->status_id == $statusSelesai->id
) {

    // =========================
    // JIKA PAYMENT DP
    // =========================
    if (
        $lastPayment &&
        $lastPayment->payment_type == 'dp'
    ) {

        // ubah jadi menunggu pelunasan
        if ($statusMenungguPelunasan) {

            $data['status_id'] =
                $statusMenungguPelunasan->id;
        }

    } else {

        // =========================
        // LANGSUNG SELESAI
        // =========================
        $data['finished_at'] = now();
    }
}

        $order->update($data);

        return back()->with(
            'success',
            'Pesanan berhasil diupdate'
        );
    }

    public function approvePayment(
    Payment $payment
) {

    $order = $payment->order;

    $payment->update([
        'status' => 'approved'
    ]);

    // =========================
    // STATUS
    // =========================
    $statusDiproses = OrderStatus::where(
        'slug',
        'diproses'
    )->first();

    $statusSelesai = OrderStatus::where(
        'slug',
        'selesai'
    )->first();

    // =========================
    // JIKA PELUNASAN
    // =========================
    if (
        $payment->payment_type == 'lunas'
    ) {

        if ($statusSelesai) {

            $order->update([

                'status_id'
                    => $statusSelesai->id,

                'finished_at'
                    => now(),
            ]);
        }

    } else {

        // =========================
        // JIKA DP
        // =========================
        if ($statusDiproses) {

            $order->update([
                'status_id' => $statusDiproses->id
            ]);
        }
    }

    return back()->with(
        'success',
        'Pembayaran berhasil dikonfirmasi'
    );
}
}