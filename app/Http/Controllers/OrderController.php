<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Accessory;
use App\Models\OrderDetail;
use App\Models\Material;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // =========================
    // FORM CREATE ORDER
    // =========================
    public function create(Request $request)
    {
        $product = Product::findOrFail(
            $request->product
        );

        $accessories = Accessory::where(
            'is_active',
            true
        )->get();

        $materials = Material::where(
            'is_active',
            true
        )->get();

        return view(
            'user.orders.create',
            compact(
                'product',
                'accessories',
                'materials'
            )
        );
    }

    // =========================
    // STORE ORDER
    // =========================
    public function store(Request $request)
    {
        $request->validate([

            'product_id'
                => 'required|exists:products,id',

            // ukuran meter
            'length'
                => 'required|numeric|min:0.1',

            'width'
                => 'required|numeric|min:0.1',

            'height'
                => 'required|numeric|min:0.1',

            'qty'
                => 'nullable|integer|min:1',

            'material_id'
                => 'required|exists:materials,id',

            'accessories'
                => 'nullable|array',

            'accessories.*'
                => 'exists:accessories,id',

            'notes'
                => 'nullable|string',

            'design_file'
                => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::transaction(function () use ($request) {

            // =========================
            // PRODUCT
            // =========================
            $product = Product::findOrFail(
                $request->product_id
            );

            // =========================
            // MATERIAL
            // =========================
            $material = Material::findOrFail(
                $request->material_id
            );

            // =========================
            // UKURAN DALAM METER
            // =========================
            $length = (float) $request->length;
            $width  = (float) $request->width;
            $height = (float) $request->height;

            $qty = $request->qty ?? 1;

            // =========================
            // HITUNG AREA
            // depan + samping
            // =========================
            $area =
                (
                    $length * $height
                )
                +
                (
                    $width * $height
                );

            $area = round($area, 2);

            // =========================
            // HARGA DASAR
            // =========================
            $basePrice =
                $area *
                $product->base_price;

            // =========================
            // HITUNG FRAME
            // =========================
            $frameLength =
                (
                    ($length * 2)
                )
                +
                (
                    ($width * 2)
                )
                +
                (
                    ($height * 4)
                );

            // =========================
            // KEBUTUHAN MATERIAL
            // =========================
            $materialQty =
                $frameLength *
                $product->frame_multiplier;

            $materialQty = round(
                $materialQty,
                2
            );

            // =========================
            // TOTAL MATERIAL
            // =========================
            $materialTotal =
                $materialQty *
                $material->price;

            // =========================
            // SUBTOTAL PRODUK
            // =========================
            $subtotal =
                (
                    $basePrice +
                    $materialTotal
                ) * $qty;

            // =========================
            // ESTIMASI AWAL
            // =========================
            $estimatedPrice = $subtotal;

            // =========================
            // UPLOAD DESIGN
            // =========================
            $designFile = null;

            if ($request->hasFile('design_file')) {

                $designFile = $request
                    ->file('design_file')
                    ->store(
                        'designs',
                        'public'
                    );
            }

            // =========================
            // CREATE ORDER
            // =========================
            $order = Order::create([

                'user_id'
                    => Auth::id(),

                'product_id'
                    => $product->id,

                'code'
                    => 'ORD-' .
                    now()->format('YmdHis') .
                    rand(100, 999),

                'status_id'
                    => 1,

                'user_notes'
                    => $request->notes,

                'design_file'
                    => $designFile,

                'estimated_price'
                    => 0,
            ]);

            // =========================
            // CREATE DETAIL
            // =========================
            $orderDetail = OrderDetail::create([

                'order_id'
                    => $order->id,

                'product_id'
                    => $product->id,

                'length'
                    => $length,

                'width'
                    => $width,

                'height'
                    => $height,

                'area'
                    => $area,

                'qty'
                    => $qty,

                'material_id'
                    => $material->id,

                'material_qty'
                    => $materialQty,

                'unit_price'
                    => round(
                        $basePrice +
                        $materialTotal,
                        2
                    ),

                'subtotal'
                    => round(
                        $subtotal,
                        2
                    ),

                'notes'
                    => $request->notes,
            ]);

            // =========================
            // ACCESSORIES
            // =========================
            if ($request->accessories) {

                $accessories = Accessory::whereIn(
                    'id',
                    $request->accessories
                )->get();

                foreach ($accessories as $accessory) {

                    $qtyAccessory = 1;

                    $subtotalAccessory =
                        $accessory->price *
                        $qtyAccessory *
                        $qty;

                    // tambah estimasi
                    $estimatedPrice +=
                        $subtotalAccessory;

                    // attach
                    $orderDetail
                        ->accessories()
                        ->attach(
                            $accessory->id,
                            [
                                'qty'
                                    => $qtyAccessory,

                                'price'
                                    => $accessory->price,

                                'subtotal'
                                    => $subtotalAccessory,
                            ]
                        );
                }
            }

            // =========================
            // UPDATE ESTIMASI
            // =========================
            $order->update([

                'estimated_price'
                    => round(
                        $estimatedPrice,
                        2
                    )
            ]);
        });

        return redirect()
            ->route('user.dashboard')
            ->with(
                'success',
                'Pesanan berhasil dibuat'
            );
    }

    // =========================
    // USER DETAIL ORDER
    // =========================
    public function showMyOrder(Order $order)
    {
        if (
            $order->user_id
            != Auth::id()
        ) {
            abort(403);
        }

        $order->load([
            'product',
            'detail.material',
            'detail.accessories',
            'payments',
            'status',
        ]);

        return view(
            'user.orders.show',
            compact('order')
        );
    }

    // =========================
    // USER ORDER HISTORY
    // =========================
    public function myOrders()
    {
        $orders = Order::with([
            'product',
            'status',
        ])
        ->where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view(
            'user.orders.index',
            compact('orders')
        );
    }

    public function track($code)
    {
        $order = Order::with([
            'product',
            'status',
        ])
        ->where('code', $code)
        ->first();

        if (!$order) {

            return response()->json([
                'success' => false
            ]);
        }

        $statuses = \App\Models\OrderStatus::all();

        return response()->json([
            'success' => true,
            'order' => $order,
            'statuses' => $statuses
        ]);
    }
}