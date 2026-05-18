
@extends('layouts.admin')

@section('content')
<x-breadcrumb />
<div class="min-h-screen bg-gray-50 p-4 md:p-6">

    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    Data Pesanan
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Daftar seluruh pesanan customer
                </p>
            </div>

        </div>

        <!-- CARD -->
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">

            <!-- TOP -->
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="font-semibold text-gray-800">
                        List Pesanan
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Total {{ $orders->count() }} pesanan
                    </p>
                </div>

                <div class="relative w-full md:w-72">
                    <input type="text"
                           placeholder="Cari pesanan..."
                           class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none text-sm">

                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50 border-b border-gray-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Order
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase whitespace-nowrap">
                                Estimasi
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase whitespace-nowrap">
                                Harga Final
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($orders as $order)

                            @php
                                $statusColor = match($order->status->slug ?? '') {
                                    'pending' => 'gray',
                                    'checking' => 'yellow',
                                    'payment' => 'orange',
                                    'process' => 'blue',
                                    'finished' => 'purple',
                                    'ready_pickup' => 'indigo',
                                    'completed' => 'green',
                                    'cancelled' => 'red',
                                    default => 'gray'
                                };
                            @endphp

                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-800 whitespace-nowrap">
                                        {{ $order->code }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-800 whitespace-nowrap">
                                        {{ $order->user->name ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Illuminate\Support\Str::limit($order->detail->product->name ?? '-', 8, '...') }}
                                </td>

                                <td class="px-6 py-4">

                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700 whitespace-nowrap">

                                        <span class="w-2 h-2 rounded-full bg-{{ $statusColor }}-500"></span>

                                        {{ $order->status->name ?? '-' }}

                                    </span>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-700">
                                    Rp {{ number_format($order->estimated_price ?? 0,0,',','.') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap font-bold text-indigo-700">
                                    Rp {{ number_format($order->final_price ?? 0,0,',','.') }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center">

                                        <a href="{{ url('/admin/orders/' . $order->id) }}"
                                           class="w-10 h-10 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 flex items-center justify-center transition">

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



