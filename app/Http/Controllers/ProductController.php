<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // =========================
    // LIST PRODUCT ADMIN
    // =========================
    public function index()
    {
        $products = Product::latest()->get();

        return view(
            'admin.products.index',
            compact('products')
        );
    }

    // =========================
    // FORM CREATE PRODUCT
    // =========================
    public function create()
    {
        return view(
            'admin.products.create'
        );
    }

    // =========================
    // STORE PRODUCT
    // =========================
    public function store(Request $request)
    {
        $request->validate([

            'name'
                => 'required|string|max:255',

            'description'
                => 'nullable|string',

            // harga per m²
            'base_price'
                => 'required|numeric|min:0',

            // ukuran dalam meter
            'standard_length'
                => 'nullable|numeric|min:0.1',

            'standard_width'
                => 'nullable|numeric|min:0.1',

            'standard_height'
                => 'nullable|numeric|min:0.1',

            // pengali kebutuhan frame
            'frame_multiplier'
                => 'nullable|numeric|min:0.1',

            'image'
                => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );
        }

        Product::create([

            'name'
                => $request->name,

            'description'
                => $request->description,

            'base_price'
                => $request->base_price,

            'standard_length'
                => $request->standard_length,

            'standard_width'
                => $request->standard_width,

            'standard_height'
                => $request->standard_height,

            'frame_multiplier'
                => $request->frame_multiplier ?? 1,

            'image'
                => $imagePath,

            'is_active'
                => true,
        ]);

        return redirect('/admin/products')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );
    }

    // =========================
    // SHOW PRODUCT
    // =========================
    public function show(Product $product)
    {
        return view(
            'admin.products.show',
            compact('product')
        );
    }

    // =========================
    // FORM EDIT PRODUCT
    // =========================
    public function edit(Product $product)
    {
        return view(
            'admin.products.edit',
            compact('product')
        );
    }

    // =========================
    // UPDATE PRODUCT
    // =========================
    public function update(
        Request $request,
        Product $product
    )
    {

        $request->validate([

            'name'
                => 'required|string|max:255',

            'description'
                => 'nullable|string',

            'base_price'
                => 'required|numeric|min:0',

            'standard_length'
                => 'nullable|numeric|min:0.1',

            'standard_width'
                => 'nullable|numeric|min:0.1',

            'standard_height'
                => 'nullable|numeric|min:0.1',

            'frame_multiplier'
                => 'nullable|numeric|min:0.1',

            'image'
                => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // =========================
        // IMAGE DEFAULT
        // =========================
        $imagePath = $product->image;

        // =========================
        // UPLOAD IMAGE BARU
        // =========================
        if ($request->hasFile('image')) {

            if ($product->image) {

                Storage::disk('public')
                    ->delete($product->image);
            }

            $imagePath = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );
        }

        // =========================
        // UPDATE PRODUCT
        // =========================
        $product->update([

            'name'
                => $request->name,

            'description'
                => $request->description,

            'base_price'
                => $request->base_price,

            'standard_length'
                => $request->standard_length,

            'standard_width'
                => $request->standard_width,

            'standard_height'
                => $request->standard_height,

            'frame_multiplier'
                => $request->frame_multiplier ?? 1,

            'image'
                => $imagePath,
        ]);

        return redirect('/admin/products')
            ->with(
                'success',
                'Produk berhasil diupdate'
            );
    }

    // =========================
    // DELETE PRODUCT
    // =========================
    public function destroy(Product $product)
    {
        if ($product->image) {

            Storage::disk('public')
                ->delete($product->image);
        }

        $product->delete();

        return redirect('/admin/products')
            ->with(
                'success',
                'Produk berhasil dihapus'
            );
    }

    // =========================
    // HOME PRODUCT
    // =========================
    public function home()
    {
        $products = Product::where(
                'is_active',
                true
            )
            ->latest()
            ->take(4)
            ->get();

        return view(
            'home',
            compact('products')
        );
    }

    // =========================
    // PUBLIC PRODUCT
    // =========================
    public function publicIndex()
    {
        $products = Product::where(
                'is_active',
                true
            )
            ->latest()
            ->get();

        return view(
            'user.products.index',
            compact('products')
        );
    }
}