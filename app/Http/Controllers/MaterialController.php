<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::latest()->get();

        return view(
            'admin.materials.index',
            compact('materials')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.materials.create');
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

        Material::create([
            'name' => $request->name,

            'price' => $request->price,

            'description'
                => $request->description,

            'is_active'
                => $request->is_active ? true : false,
        ]);

        return redirect('/admin/materials')
            ->with(
                'success',
                'Material berhasil ditambahkan'
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view(
            'admin.materials.edit',
            compact('material')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Material $material
    ) {

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $material->update([
            'name' => $request->name,

            'price' => $request->price,

            'description'
                => $request->description,

            'is_active'
                => $request->is_active ? true : false,
        ]);

        return redirect('/admin/materials')
            ->with(
                'success',
                'Material berhasil diupdate'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect('/admin/materials')
            ->with(
                'success',
                'Material berhasil dihapus'
            );
    }
}