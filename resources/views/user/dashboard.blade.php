

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
                    Pesanan yang belum dibayar atau masih DP
                </p>

            </div>

            <div class="px-4 py-2 rounded-xl bg-amber-100 text-amber-600 text-sm font-semibold">

                {{ $paymentOrders->count() }} Pesanan

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr class="text-left text-sm text-slate-600">

                        <th class="px-6 py-4 font-semibold">
                            Kode
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Produk
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Total
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

                <tbody class="divide-y divide-slate-100">

                    @forelse($paymentOrders as $order)

                        <tr class="hover:bg-slate-50 transition">

                            <!-- KODE -->
                            <td class="px-6 py-5 font-semibold text-slate-700">

                                {{ $order->code }}

                            </td>

                            <!-- PRODUK -->
                            <td class="px-6 py-5">

                                {{ $order->product->name ?? '-' }}

                            </td>

                            <!-- TANGGAL -->
                            <td class="px-6 py-5 text-slate-500">

                                {{ $order->created_at->format('d M Y') }}

                            </td>

                            <!-- TOTAL -->
                            <td class="px-6 py-5 font-semibold text-slate-700">

                                Rp {{ number_format($order->estimated_price,0,',','.') }}

                            </td>

                            <!-- PEMBAYARAN -->
                            <td class="px-6 py-5">

                                @if($order->status_id == 1)

                                    <span class="px-4 py-2 rounded-full text-xs font-semibold bg-red-100 text-red-600">

                                        Belum Bayar

                                    </span>

                                @elseif($order->status_id == 2)

                                    <span class="px-4 py-2 rounded-full text-xs font-semibold bg-amber-100 text-amber-600">

                                        DP

                                    </span>

                                @endif

                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-5">

                                <span class="px-4 py-2 rounded-full text-xs font-semibold bg-sky-100 text-sky-600">

                                    {{ $order->status->name ?? '-' }}

                                </span>

                            </td>

                            <!-- AKSI -->
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- DETAIL -->
                                    <a
                                        href="{{ url('/orders/'.$order->id) }}"
                                        class="px-4 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm transition"
                                    >
                                        Detail
                                    </a>

                                    <!-- BAYAR -->
                                    <a
                                        href="#"
                                        class="px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-sm transition"
                                    >
                                        Bayar
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-6 py-10 text-center text-slate-500">

                                Tidak ada pesanan menunggu pembayaran

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>
@endsection