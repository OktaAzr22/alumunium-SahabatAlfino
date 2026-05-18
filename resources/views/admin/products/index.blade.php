@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4 md:px-6">

    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Data Produk
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh data produk
                </p>
            </div>

            <a href="{{ url('/admin/products/create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition shadow-sm">

                <i class="fas fa-plus text-xs"></i>

                Tambah Produk

            </a>

        </div>

        <!-- ALERT -->
        @if(session('success'))

        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center gap-3">

            <i class="fas fa-check-circle"></i>

            {{ session('success') }}

        </div>

        @endif

        <!-- TABLE CARD -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <!-- TOP -->
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="font-semibold text-gray-800">
                        List Produk
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Total {{ $products->count() }} produk
                    </p>
                </div>

                <div class="relative">

                    <input type="text"
                           placeholder="Cari produk..."
                           class="w-full md:w-72 pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none text-sm">

                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50 border-b border-gray-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Harga
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Ukuran
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Multiplier
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Deskripsi
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($products as $product)

                            @php
                                $description = $product->description;

                                if(strlen($description) > 40){
                                    $description = substr($description,0,40).'...';
                                }
                            @endphp

                            <tr class="hover:bg-gray-50 transition">

                                <!-- PRODUK -->
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-4">

                                        @if($product->image)

                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 class="w-16 h-16 rounded-xl object-cover border border-gray-200">

                                        @else

                                            <div class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">

                                                <i class="fas fa-image"></i>

                                            </div>

                                        @endif

                                        <div>

                                            <h3 class="font-semibold text-gray-800">
                                                {{ $product->name }}
                                            </h3>

                                            <p class="text-sm text-gray-500 mt-1">
                                                ID: #{{ $product->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <!-- HARGA -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <span class="font-semibold text-indigo-700">
                                        Rp {{ number_format($product->base_price,0,',','.') }}
                                    </span>

                                </td>

                                <!-- UKURAN -->
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">

                                    @if(
                                        $product->standard_length &&
                                        $product->standard_width &&
                                        $product->standard_height
                                    )

                                        {{ $product->standard_length }}
                                        x
                                        {{ $product->standard_width }}
                                        x
                                        {{ $product->standard_height }} cm

                                    @else

                                        -

                                    @endif

                                </td>

                                <!-- MULTIPLIER -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-semibold">

                                        {{ $product->frame_multiplier }}

                                    </span>

                                </td>

                                <!-- DESKRIPSI -->
                                <td class="px-6 py-4 text-gray-600 text-sm">

                                    {{ $description }}

                                </td>

                                <!-- AKSI -->
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <!-- EDIT -->
                                        <a href="{{ url('/admin/products/' . $product->id . '/edit') }}"
                                           class="w-10 h-10 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center transition"
                                           title="Edit Produk">

                                            <i class="fas fa-pen text-sm"></i>

                                        </a>

                                        <!-- DELETE -->
                                        <form action="{{ url('/admin/products/' . $product->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Hapus produk ini?')"
                                                    class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center transition"
                                                    title="Hapus Produk">

                                                <i class="fas fa-trash text-sm"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-14 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">

                                            <i class="fas fa-box-open text-gray-400 text-2xl"></i>

                                        </div>

                                        <h3 class="text-lg font-semibold text-gray-700 mb-1">
                                            Belum Ada Produk
                                        </h3>

                                        <p class="text-gray-500 text-sm">
                                            Data produk akan muncul di sini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection