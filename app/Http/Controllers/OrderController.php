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
        // =========================
        // VALIDASI
        // =========================
        $request->validate([

            'product_id'
                => 'required|exists:products,id',

            'length'
                => 'required|numeric|min:1',

            'width'
                => 'required|numeric|min:1',

            'height'
                => 'required|numeric|min:1',

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

        // =========================
        // DATABASE TRANSACTION
        // =========================
        DB::transaction(function () use ($request) {

            // =========================
            // AMBIL PRODUCT
            // =========================
            $product = Product::findOrFail(
                $request->product_id
            );

            // =========================
            // AMBIL MATERIAL
            // =========================
            $material = Material::findOrFail(
                $request->material_id
            );

            // =========================
            // UKURAN
            // =========================
            $length = $request->length;
            $width  = $request->width;
            $height = $request->height;

            $qty = $request->qty ?? 1;

            // =========================
            // CM -> METER
            // =========================
            $lengthMeter = $length / 100;
            $widthMeter  = $width / 100;
            $heightMeter = $height / 100;

            // =========================
            // HITUNG LUAS
            // =========================
            $area =
                $lengthMeter *
                $widthMeter;

            // =========================
            // HARGA DASAR PRODUK
            // base_price = harga per m2
            // =========================
            $basePrice =
                $area *
                $product->base_price;

            // =========================
            // HITUNG KELILING FRAME
            // =========================
            $frameLength =
                ($lengthMeter * 2) +
                ($heightMeter * 2);

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
            // TOTAL ESTIMASI
            // =========================
            $estimatedPrice = $subtotal;

            // =========================
            // UPLOAD DESIGN FILE
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

                'code'
                    => 'ORD-' .
                    now()->format('YmdHis') .
                    rand(100, 999),

                'status'
                    => 'pending',

                'user_notes'
                    => $request->notes,

                'design_file'
                    => $designFile,

                'estimated_price'
                    => 0,
            ]);

            // =========================
            // CREATE ORDER DETAIL
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
                    => round($area, 2),

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
                        $qtyAccessory;

                    // tambah ke estimasi
                    $estimatedPrice +=
                        $subtotalAccessory;

                    // attach ke order detail
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
            // UPDATE TOTAL ESTIMASI
            // =========================
            $order->update([

                'estimated_price'
                    => round(
                        $estimatedPrice,
                        2
                    )
            ]);
        });

        return redirect('/orders/history')
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
            'accessories'
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
            'product'
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

    // =========================
    // ADMIN ORDER LIST
    // =========================
    public function index()
    {
        $orders = Order::with([
            'user',
            'product',
            'detail.material',
            'accessories'
        ])
        ->latest()
        ->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }
}