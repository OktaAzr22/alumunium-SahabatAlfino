@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- BANNER --}}
    <x-user-banner
        label="Pesanan Saya"
        title="Riwayat Pesanan"
        description="Pantau seluruh progress pesanan furnitur aluminium Anda."
    />

    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-5 flex items-center gap-4">

            <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center">

                <i class="fas fa-check-circle text-emerald-600 text-xl"></i>

            </div>

            <div>

                <h3 class="font-bold text-emerald-700">
                    Berhasil
                </h3>

                <p class="text-sm text-emerald-600 mt-1">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif

    {{-- EMPTY --}}
    @if($orders->count() == 0)

        <div class="mt-10 bg-white rounded-3xl border border-slate-200 shadow-sm p-16 text-center">

            <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center mx-auto">

                <i class="fas fa-box-open text-4xl text-slate-400"></i>

            </div>

            <h2 class="text-3xl font-extrabold text-slate-700 mt-6">
                Belum Ada Pesanan
            </h2>

            <p class="text-slate-500 mt-3 max-w-md mx-auto">
                Anda belum memiliki pesanan furnitur aluminium.
            </p>

            <a
                href="{{ url('/products') }}"
                class="inline-flex items-center px-6 py-4 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold mt-8 transition shadow-lg"
            >
                <i class="fas fa-cart-plus mr-2"></i>
                Pesan Sekarang
            </a>

        </div>

    @else

        {{-- HEADER --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-8 mb-5">

    <div>

        <h2 class="text-2xl font-bold text-slate-800">
            Data Pesanan
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Daftar seluruh pesanan furnitur aluminium Anda
        </p>

    </div>

    <a
        href="{{ url('/products') }}"
        class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold transition shadow-sm"
    >
        <i class="fas fa-plus mr-2 text-xs"></i>
        Pesan Baru
    </a>

</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full min-w-[950px]">

            {{-- HEAD --}}
            <thead class="bg-slate-50 border-b border-slate-200">

                <tr>

                    <th class="px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        No Pesanan
                    </th>

                    <th class="px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        Tanggal
                    </th>

                    <th class="px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        Estimasi
                    </th>

                    <th class="px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        Estimasi Harga
                    </th>

                    <th class="px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        Harga Final
                    </th>

                    <th class="px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        Status
                    </th>

                    <th class="px-4 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                        Aksi
                    </th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-slate-100">

                @foreach($orders as $order)

                    @php

                        $statusColor = match(strtolower($order->status->name)) {

                            'pending' => 'bg-amber-100 text-amber-600',

                            'diproses' => 'bg-sky-100 text-sky-600',

                            'selesai' => 'bg-emerald-100 text-emerald-600',

                            default => 'bg-slate-100 text-slate-600'

                        };

                    @endphp

                    <tr class="hover:bg-slate-50 transition">

                        {{-- KODE --}}
                        <td class="px-4 py-4">

                            <div>

                                <h3 class="font-semibold text-sm text-slate-800">
                                    {{ $order->code }}
                                </h3>

                                <p class="text-[11px] text-slate-400 mt-1">
                                    Furnitur Aluminium
                                </p>

                            </div>

                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-4 py-4 text-sm text-slate-600">

                            {{ $order->created_at->format('d M Y') }}

                            <p class="text-[11px] text-slate-400 mt-1">

                                {{ $order->created_at->format('H:i') }}

                            </p>

                        </td>

                        {{-- ESTIMASI --}}
                        <td class="px-4 py-4">

                            @if($order->estimated_finish)

                                <div>

                                    <span class="text-sm font-medium text-slate-700">

                                        {{ \Carbon\Carbon::parse($order->estimated_finish)->format('d M Y') }}

                                    </span>

                                    <p class="text-[11px] text-slate-400 mt-1">

                                        Pengerjaan

                                    </p>

                                </div>

                            @else

                                <span class="text-xs text-slate-400">
                                    Belum ada
                                </span>

                            @endif

                        </td>

                        {{-- ESTIMASI HARGA --}}
                        <td class="px-4 py-4">

                            <span class="text-sm font-semibold text-slate-800">

                                Rp {{ number_format($order->estimated_price,0,',','.') }}

                            </span>

                        </td>

                        {{-- FINAL --}}
                        <td class="px-4 py-4">

                            @if($order->final_price)

                                <span class="text-sm font-semibold text-emerald-600">

                                    Rp {{ number_format($order->final_price,0,',','.') }}

                                </span>

                            @else

                                <span class="text-xs text-slate-400">
                                    -
                                </span>

                            @endif

                        </td>

                        {{-- STATUS --}}
                        <td class="px-4 py-4">

                            <span class="px-3 py-1.5 rounded-full text-[11px] font-semibold {{ $statusColor }}">

                                {{ strtoupper($order->status->name) }}

                            </span>

                        </td>

                        {{-- AKSI --}}
                        <td class="px-4 py-4">

                            <div class="flex items-center justify-center gap-2">

                                {{-- DETAIL --}}
                                <a
                                    href="{{ url('/my-orders/' . $order->id) }}"
                                    title="Detail Pesanan"
                                    class="w-9 h-9 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white flex items-center justify-center transition"
                                >
                                    <i class="fas fa-eye text-sm"></i>
                                </a>

                                {{-- BAYAR --}}
                                @if(strtolower($order->status->name) == 'pending')

                                    <a
                                        href="#"
                                        title="Bayar Pesanan"
                                        class="w-9 h-9 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center transition"
                                    >
                                        <i class="fas fa-wallet text-sm"></i>
                                    </a>

                                @endif

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

    @endif

</section>

@endsection