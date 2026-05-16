<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessories = Accessory::latest()->get();

        return view(
            'admin.accessories.index',
            compact('accessories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accessories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Accessory::create([
            'name' => $request->name,

            'category' => $request->category,

            'price' => $request->price,

            'is_active'
                => $request->is_active ? true : false,
        ]);

        return redirect('/admin/accessories')
            ->with(
                'success',
                'Accessory berhasil ditambahkan'
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accessory $accessory)
    {
        return view(
            'admin.accessories.edit',
            compact('accessory')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Accessory $accessory
    ) {

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $accessory->update([
            'name' => $request->name,

            'category' => $request->category,

            'price' => $request->price,

            'is_active'
                => $request->is_active ? true : false,
        ]);

        return redirect('/admin/accessories')
            ->with(
                'success',
                'Accessory berhasil diupdate'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accessory $accessory)
    {
        $accessory->delete();

        return redirect('/admin/accessories')
            ->with(
                'success',
                'Accessory berhasil dihapus'
            );
    }
}