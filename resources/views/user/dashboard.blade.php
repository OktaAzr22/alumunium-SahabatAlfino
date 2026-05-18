

@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <x-user-banner
        label="Dashboard User"
        title="Selamat Datang,"
        description="Kelola pesanan furnitur aluminium Anda dengan mudah."
        image="https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=1600&auto=format&fit=crop"
    />
    <x-session-alert />

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-8">

        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Pesanan</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-1">{{ $totalOrders }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-box text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Menunggu Pembayaran</p>
                    <h2 class="text-3xl font-bold text-amber-500 mt-1">{{ $waitingPayment }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-wallet text-amber-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pesanan Selesai</p>
                    <h2 class="text-3xl font-bold text-cyan-600 mt-1">{{ $completedOrders }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-cyan-600 text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- TABLE MENUNGGU PEMBAYARAN -->
    <div class="mt-10 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- HEADER -->
        <div class="p-6 border-b border-slate-200 flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Menunggu Pembayaran
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    List pesanan baru masuk, belum bayar, atau masi DP
                </p>

            </div>

            <div class="px-4 py-2 rounded-xl bg-amber-100 text-amber-600 text-sm font-semibold">

                {{ $paymentOrders->count() }} Pesanan

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

    <table class="w-full">

        <!-- HEAD -->
        <thead class="bg-slate-50 border-b border-slate-100">

            <tr class="text-left text-xs uppercase tracking-wide text-slate-500">

                <th class="px-6 py-4 font-semibold">
                    Resi
                </th>

                <th class="px-6 py-4 font-semibold">
                    Produk
                </th>

                <th class="px-6 py-4 font-semibold">
                    Tanggal
                </th>

                <th class="px-6 py-4 font-semibold">
                    Total Harga
                </th>

                <th class="px-6 py-4 font-semibold">
                    Pembayaran
                </th>

                <th class="px-6 py-4 font-semibold">
                    Status
                </th>

                <th class="px-6 py-4 font-semibold text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <!-- BODY -->
        <tbody class="divide-y divide-slate-100 bg-white">

            @forelse($paymentOrders as $order)

                @php

                    $statusName = strtolower(
                        $order->status->name ?? ''
                    );

                @endphp

                <tr class="hover:bg-slate-50 transition">

                    <!-- RESI -->
                    <td class="px-6 py-5">

                        <div class="font-semibold text-slate-800">

                            {{ $order->code }}

                        </div>

                    </td>

                    <!-- PRODUK -->
                    <td class="px-6 py-5">

                        <div class="font-medium text-slate-700">

                            {{ $order->product->name ?? '-' }}

                        </div>

                    </td>

                    <!-- TANGGAL -->
                    <td class="px-6 py-5 text-slate-500 text-sm">

                        {{ $order->created_at->format('d M Y') }}

                    </td>

                    <!-- TOTAL -->
                    <td class="px-6 py-5">

                        <div class="font-semibold text-slate-800">

                            @php

                                $price =
                                    $order->final_price
                                    ?? $order->estimated_price;

                            @endphp

                            Rp {{ number_format($price,0,',','.') }}

                        </div>

                    </td>

                    <!-- PEMBAYARAN -->
                    <td class="px-6 py-5">

                        @if($statusName === 'pending')

                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">

                                Belum Bayar

                            </span>

                        @elseif($statusName === 'menunggu pembayaran')

                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">

                                Menunggu Pembayaran

                            </span>

                        @elseif($statusName === 'dicek admin')

                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">

                                Dicek Admin

                            </span>

                        @endif

                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-5">

                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">

                            {{ $order->status->name ?? '-' }}

                        </span>

                    </td>

                    
                    <!-- AKSI -->
                    <td class="px-6 py-5">

                        <div class="flex items-center justify-center">

                            <!-- DETAIL -->
                            <a
                                href="{{ url('/my-orders/'.$order->id) }}"
                                class="
                                    w-10
                                    h-10
                                    rounded-xl
                                    bg-sky-50
                                    hover:bg-sky-100
                                    text-sky-600
                                    flex
                                    items-center
                                    justify-center
                                    transition
                                "
                                title="Detail Pesanan"
                            >

                                <i class="fas fa-eye text-sm"></i>

                            </a>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="px-6 py-14 text-center">

                        <div class="flex flex-col items-center">

                            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">

                                <i class="fas fa-receipt text-slate-400 text-2xl"></i>

                            </div>

                            <h3 class="text-lg font-semibold text-slate-700 mb-1">

                                Tidak Ada Pembayaran

                            </h3>

                            <p class="text-sm text-slate-500">

                                Pesanan menunggu pembayaran akan muncul di sini.

                            </p>

                        </div>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

    </div>

</section>
@endsection