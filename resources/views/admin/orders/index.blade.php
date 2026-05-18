@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4 md:px-6">

    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Data Pesanan
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Daftar seluruh pesanan customer
                </p>
            </div>

            <a href="#"
               class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition">
                <i class="fas fa-plus text-xs"></i>
                Tambah Pesanan
            </a>

        </div>

        <!-- CARD TABLE -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- TOP BAR -->
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="font-semibold text-gray-800">
                        List Pesanan
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Total {{ $orders->count() }} pesanan
                    </p>
                </div>

                <div class="relative">
                    <input type="text"
                           placeholder="Cari pesanan..."
                           class="w-full md:w-72 pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none text-sm">

                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50 border-b border-gray-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Kode
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Estimasi
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Harga Final
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

    @forelse($orders as $order)

        @php
            $statusColor = match(strtolower($order->status)) {
                'pending' => 'yellow',
                'process' => 'blue',
                'completed' => 'green',
                'cancelled' => 'red',
                default => 'gray'
            };

            $productName = $order->detail->product->name ?? '-';

            if(strlen($productName) > 8){
                $productName = substr($productName, 0, 8) . '...';
            }
        @endphp

        <tr class="hover:bg-gray-50 transition">

            <!-- KODE -->
            <td class="px-6 py-4 whitespace-nowrap">

                <div class="font-semibold text-gray-800">
                    {{ $order->code }}
                </div>

            </td>

            <!-- CUSTOMER -->
            <td class="px-6 py-4 whitespace-nowrap">

                <h3 class="font-medium text-gray-800">
                    {{ $order->user->name }}
                </h3>

            </td>

            <!-- PRODUK -->
            <td class="px-6 py-4 whitespace-nowrap text-gray-700">

                {{ $productName }}

            </td>

            <!-- STATUS -->
            <td class="px-6 py-4 whitespace-nowrap">

                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700">

                    <span class="w-2 h-2 rounded-full bg-{{ $statusColor }}-500"></span>

                    {{ strtoupper($order->status) }}

                </span>

            </td>

            <!-- ESTIMASI -->
            <td class="px-6 py-4 whitespace-nowrap">

                <span class="font-medium text-gray-700">
                    Rp {{ number_format($order->estimated_price,0,',','.') }}
                </span>

            </td>

            <!-- FINAL -->
            <td class="px-6 py-4 whitespace-nowrap">

                <span class="font-bold text-indigo-700">
                    Rp {{ number_format($order->final_price,0,',','.') }}
                </span>

            </td>

            <!-- AKSI -->
            <td class="px-6 py-4 whitespace-nowrap">

                <div class="flex items-center justify-center">

                    <a href="/admin/orders/{{ $order->id }}"
                       class="w-10 h-10 flex items-center justify-center bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-xl transition"
                       title="Detail Pesanan">

                        <i class="fas fa-eye text-sm"></i>

                    </a>

                </div>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="7" class="px-6 py-14 text-center">

                <div class="flex flex-col items-center">

                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">

                        <i class="fas fa-box-open text-gray-400 text-2xl"></i>

                    </div>

                    <h3 class="text-lg font-semibold text-gray-700 mb-1">
                        Belum Ada Pesanan
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Data pesanan akan muncul di sini.
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

