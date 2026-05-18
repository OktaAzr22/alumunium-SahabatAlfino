@extends('layouts.admin')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Dashboard Admin
            </h1>

            <p class="text-gray-500 mt-1">
                Selamat datang kembali, {{ Auth::user()->name }}
            </p>

        </div>

        <div class="bg-white border border-gray-200 rounded-2xl px-5 py-3 shadow-sm">

            <p class="text-sm text-gray-500">
                Hari Ini
            </p>

            <h2 class="font-semibold text-gray-800">
                {{ now()->translatedFormat('d F Y') }}
            </h2>

        </div>

    </div>

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- PRODUCT -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Product
                    </p>

                    <h2 class="text-4xl font-bold text-gray-800 mt-3">
                        {{ $totalProducts }}
                    </h2>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center">

                    <i class="fas fa-box text-indigo-600 text-2xl"></i>

                </div>

            </div>

        </div>

        <!-- MATERIAL -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Material
                    </p>

                    <h2 class="text-4xl font-bold text-gray-800 mt-3">
                        {{ $totalMaterials }}
                    </h2>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center">

                    <i class="fas fa-layer-group text-emerald-600 text-2xl"></i>

                </div>

            </div>

        </div>

        <!-- ACCESSORY -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Aksesoris
                    </p>

                    <h2 class="text-4xl font-bold text-gray-800 mt-3">
                        {{ $totalAccessories }}
                    </h2>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i class="fas fa-gem text-yellow-500 text-2xl"></i>

                </div>

            </div>

        </div>

        <!-- ORDER -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Pesanan
                    </p>

                    <h2 class="text-4xl font-bold text-gray-800 mt-3">
                        {{ $totalOrders }}
                    </h2>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center">

                    <i class="fas fa-shopping-cart text-rose-500 text-2xl"></i>

                </div>

            </div>

        </div>

    </div>

    @php
    use Illuminate\Support\Str;
@endphp

<!-- TABLE -->
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 mt-8 overflow-hidden">

    <!-- TABLE HEADER -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">

        <div>

            <h2 class="text-lg font-bold text-gray-800">
                Pesanan Terbaru
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Data transaksi customer terbaru
            </p>

        </div>

        <a
            href="{{ url('/admin/orders') }}"
            class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition"
        >
            Lihat Semua
        </a>

    </div>

    <!-- TABLE CONTENT -->
    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left font-semibold text-gray-600">
                        Kode Order
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-600">
                        Customer
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-600">
                        Product
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-600">
                        Total
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-gray-600">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($latestOrders as $order)

                <tr class="border-t border-gray-100 hover:bg-gray-50 transition">

                    <!-- CODE -->
                    <td class="px-6 py-4 font-semibold text-gray-700">
                        {{ $order->code }}
                    </td>

                    <!-- CUSTOMER -->
                    <td class="px-6 py-4 text-gray-600">
                        {{ $order->user->name ?? '-' }}
                    </td>

                    <!-- PRODUCT -->
                    <td class="px-6 py-4 text-gray-600 max-w-[220px]">

                        <span
                            class="block truncate"
                            title="{{ $order->product->name ?? '-' }}"
                        >
                            {{ Str::limit($order->product->name ?? '-', 8, '...') }}
                        </span>

                    </td>

                    <!-- TOTAL -->
                    <td class="px-6 py-4 font-semibold text-indigo-600">
                        Rp {{ number_format($order->estimated_price,0,',','.') }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4">

                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">

                            {{ $order->status->name ?? '-' }}

                        </span>

                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-4 text-center">

                        <a
                            href="{{ url('/admin/orders/'.$order->id) }}"
                            class="w-10 h-10 inline-flex items-center justify-center rounded-xl bg-gray-900 text-white hover:bg-black transition"
                            title="Detail Order"
                        >

                            <i class="fas fa-eye text-sm"></i>

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="px-6 py-10 text-center text-gray-400">

                        Belum ada data pesanan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection