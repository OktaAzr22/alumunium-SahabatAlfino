@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- BANNER --}}
    <x-user-banner
        label="Produk Furnitur"
        title="Katalog Produk"
        description="Temukan berbagai furnitur aluminium premium dengan desain modern."
    />

    {{-- HEADER --}}
    <div class="flex items-center justify-between mt-10 mb-6">

        <div>

            <h2 class="text-3xl font-extrabold text-slate-800">
                Semua Produk
            </h2>

            <p class="text-slate-500 mt-2">
                Pilih furnitur aluminium sesuai kebutuhan Anda
            </p>

        </div>

    </div>

    {{-- GRID PRODUK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($products as $product)

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-xl transition duration-300 group">

                {{-- IMAGE --}}
                <div class="relative overflow-hidden">

                    <img
                        src="{{ $product->image 
                            ? asset('storage/'.$product->image) 
                            : 'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=1600&auto=format&fit=crop' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-60 object-cover group-hover:scale-105 transition duration-500"
                    >

                    <div class="absolute top-4 left-4">

                        <span class="px-3 py-1 rounded-full bg-emerald-500 text-white text-xs font-semibold shadow-lg">
                            Aluminium
                        </span>

                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="p-5">

                    <h3 class="text-xl font-bold text-slate-800 line-clamp-1">
                        {{ $product->name }}
                    </h3>

                    <p class="text-sm text-slate-500 mt-2 line-clamp-2">
                        {{ $product->description }}
                    </p>

                    {{-- PRICE --}}
                    <div class="mt-4">

                        <p class="text-sm text-slate-400">
                            Harga mulai
                        </p>

                        <h4 class="text-2xl font-extrabold text-emerald-600 mt-1">

                            Rp {{ number_format($product->base_price,0,',','.') }}

                        </h4>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-6 flex gap-3">

                        {{-- DETAIL --}}
                        <button
                            onclick="openModal('productModal{{ $product->id }}')"
                            class="flex-1 px-4 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold transition"
                        >
                            <i class="fas fa-eye mr-2"></i>
                            Detail
                        </button>

                        {{-- PESAN --}}
                        <a
                            href="{{ url('/orders/create?product='.$product->id) }}"
                            class="flex-1 px-4 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold transition text-center"
                        >
                            <i class="fas fa-cart-plus mr-2"></i>
                            Pesan
                        </a>

                    </div>

                </div>

            </div>

            {{-- MODAL DETAIL --}}
            <div
                id="productModal{{ $product->id }}"
                class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4"
            >

                <div class="bg-white rounded-3xl max-w-4xl w-full overflow-hidden shadow-2xl relative animate-fadeIn">

                    {{-- CLOSE --}}
                    <button
                        onclick="closeModal('productModal{{ $product->id }}')"
                        class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white shadow-lg hover:bg-slate-100 transition z-10"
                    >
                        <i class="fas fa-times text-slate-600"></i>
                    </button>

                    <div class="grid md:grid-cols-2">

                        {{-- IMAGE --}}
                        <div>

                            <img
                                src="{{ $product->image 
                                    ? asset('storage/'.$product->image) 
                                    : 'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=1600&auto=format&fit=crop' }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                            >

                        </div>

                        {{-- CONTENT --}}
                        <div class="p-8">

                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-xs font-semibold">
                                Furnitur Aluminium
                            </span>

                            <h2 class="text-4xl font-extrabold text-slate-800 mt-4">
                                {{ $product->name }}
                            </h2>

                            <p class="text-slate-500 mt-4 leading-relaxed">
                                {{ $product->description }}
                            </p>

                            {{-- HARGA --}}
                            <div class="mt-6">

                                <p class="text-sm text-slate-400">
                                    Harga mulai dari
                                </p>

                                <h3 class="text-4xl font-extrabold text-emerald-600 mt-2">

                                    Rp {{ number_format($product->base_price,0,',','.') }}

                                </h3>

                            </div>

                            {{-- SPESIFIKASI --}}
                            <div class="mt-8 grid grid-cols-2 gap-4">

                                <div class="bg-slate-50 rounded-2xl p-4">

                                    <p class="text-sm text-slate-400">
                                        Panjang
                                    </p>

                                    <h4 class="text-lg font-bold text-slate-700 mt-1">
                                        {{ $product->standard_length ?? '-' }} cm
                                    </h4>

                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4">

                                    <p class="text-sm text-slate-400">
                                        Lebar
                                    </p>

                                    <h4 class="text-lg font-bold text-slate-700 mt-1">
                                        {{ $product->standard_width ?? '-' }} cm
                                    </h4>

                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4">

                                    <p class="text-sm text-slate-400">
                                        Tinggi
                                    </p>

                                    <h4 class="text-lg font-bold text-slate-700 mt-1">
                                        {{ $product->standard_height ?? '-' }} cm
                                    </h4>

                                </div>

                                <div class="bg-slate-50 rounded-2xl p-4">

                                    <p class="text-sm text-slate-400">
                                        Material
                                    </p>

                                    <h4 class="text-lg font-bold text-slate-700 mt-1">
                                        Aluminium
                                    </h4>

                                </div>

                            </div>

                            {{-- BUTTON --}}
                            <div class="mt-8">

                                <a
                                    href="{{ url('/orders/create?product='.$product->id) }}"
                                    class="w-full inline-flex items-center justify-center px-6 py-4 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold transition"
                                >
                                    <i class="fas fa-cart-plus mr-2"></i>
                                    Pesan Sekarang
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full bg-white rounded-3xl p-16 text-center shadow-sm border border-slate-200">

                <i class="fas fa-box-open text-6xl text-slate-300"></i>

                <h3 class="text-2xl font-bold text-slate-700 mt-5">
                    Produk Belum Tersedia
                </h3>

                <p class="text-slate-500 mt-2">
                    Silakan tambahkan produk terlebih dahulu
                </p>

            </div>

        @endforelse

    </div>

</section>

@endsection