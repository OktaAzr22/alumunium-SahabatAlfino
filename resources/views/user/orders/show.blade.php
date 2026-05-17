@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- LEFT --}}
        <div class="lg:w-2/3">

            {{-- CARD --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- TOP --}}
                <div class="p-6 border-b border-slate-100 flex items-start justify-between gap-4">

                    <div>

                        <p class="text-sm text-slate-400">
                            Detail Pesanan
                        </p>

                        <h1 class="text-2xl font-bold text-slate-800 mt-1">

                            {{ $order->code }}

                        </h1>

                        <p class="text-sm text-slate-500 mt-2">

                            {{ $order->created_at->format('d M Y H:i') }}

                        </p>

                    </div>

                    @php

                        $statusColor = match(strtolower($order->status->name)) {

                            'pending' => 'bg-amber-100 text-amber-600',

                            'diproses' => 'bg-sky-100 text-sky-600',

                            'selesai' => 'bg-emerald-100 text-emerald-600',

                            default => 'bg-slate-100 text-slate-600'

                        };

                    @endphp

                    <span class="px-4 py-2 rounded-full text-xs font-semibold {{ $statusColor }}">

                        {{ strtoupper($order->status->name) }}

                    </span>

                </div>

                {{-- BODY --}}
                <div class="p-6 space-y-8">

                    {{-- PRODUK --}}
                    <div>

                        <h3 class="text-lg font-bold text-slate-800 mb-4">
                            Produk
                        </h3>

                        <div class="flex flex-col md:flex-row gap-5">

                            @if($order->detail->product->image)

                                <img
                                    src="{{ asset('storage/' . $order->detail->product->image) }}"
                                    class="w-full md:w-56 h-52 object-cover rounded-2xl border border-slate-200"
                                >

                            @endif

                            <div class="flex-1">

                                <h4 class="text-xl font-bold text-slate-800">

                                    {{ $order->detail->product->name }}

                                </h4>

                                <p class="text-sm text-slate-500 mt-3 leading-relaxed">

                                    {{ $order->detail->product->description ?? 'Produk furnitur aluminium custom premium.' }}

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- DETAIL --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- UKURAN --}}
                        <div class="bg-slate-50 rounded-2xl p-5">

                            <h4 class="font-bold text-slate-700 mb-4">
                                Ukuran Custom
                            </h4>

                            <div class="space-y-2 text-sm text-slate-600">

                                <p>
                                    Panjang:
                                    <span class="font-semibold">
                                        {{ $order->detail->length }} cm
                                    </span>
                                </p>

                                <p>
                                    Lebar:
                                    <span class="font-semibold">
                                        {{ $order->detail->width }} cm
                                    </span>
                                </p>

                                <p>
                                    Tinggi:
                                    <span class="font-semibold">
                                        {{ $order->detail->height }} cm
                                    </span>
                                </p>

                            </div>

                        </div>

                        {{-- MATERIAL --}}
                        <div class="bg-slate-50 rounded-2xl p-5">

                            <h4 class="font-bold text-slate-700 mb-4">
                                Material
                            </h4>

                            <div class="space-y-2 text-sm text-slate-600">

                                <p>

                                    Material:
                                    <span class="font-semibold">

                                        {{ $order->detail->material->name }}

                                    </span>

                                </p>

                                <p>

                                    Kebutuhan:
                                    <span class="font-semibold">

                                        {{ $order->detail->material_qty }}
                                        {{ $order->detail->material->unit }}

                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- ACCESSORIES --}}
                    <div>

                        <h3 class="text-lg font-bold text-slate-800 mb-4">
                            Accessories
                        </h3>

                        @if($order->detail->accessories->count())

                            <div class="overflow-x-auto">

                                <table class="w-full">

                                    <thead class="bg-slate-50">

                                        <tr>

                                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                                Nama
                                            </th>

                                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                                Qty
                                            </th>

                                            <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                                Subtotal
                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody class="divide-y divide-slate-100">

                                        @foreach($order->detail->accessories as $accessory)

                                            <tr>

                                                <td class="px-4 py-4 text-sm text-slate-700">
                                                    {{ $accessory->name }}
                                                </td>

                                                <td class="px-4 py-4 text-sm text-slate-700">
                                                    {{ $accessory->pivot->qty }}x
                                                </td>

                                                <td class="px-4 py-4 text-sm font-semibold text-slate-800">
                                                    Rp {{ number_format($accessory->pivot->subtotal,0,',','.') }}
                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        @else

                            <div class="bg-slate-50 rounded-2xl p-5 text-sm text-slate-500">

                                Tidak ada accessories

                            </div>

                        @endif

                    </div>

                    {{-- NOTES --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div class="bg-slate-50 rounded-2xl p-5">

                            <h4 class="font-bold text-slate-700 mb-3">
                                Catatan Tambahan
                            </h4>

                            <p class="text-sm text-slate-600 leading-relaxed">

                                {{ $order->detail->notes ?? '-' }}

                            </p>

                        </div>

                        <div class="bg-slate-50 rounded-2xl p-5">

                            <h4 class="font-bold text-slate-700 mb-3">
                                Catatan Admin
                            </h4>

                            <p class="text-sm text-slate-600 leading-relaxed">

                                {{ $order->admin_notes ?? '-' }}

                            </p>

                        </div>

                    </div>

                    {{-- DESIGN --}}
                    @if($order->design_file)

                        <div>

                            <h3 class="text-lg font-bold text-slate-800 mb-4">
                                Design Custom
                            </h3>

                            <img
                                src="{{ asset('storage/' . $order->design_file) }}"
                                class="w-full max-w-md rounded-2xl border border-slate-200 shadow-sm"
                            >

                        </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="lg:w-1/3 space-y-6">

            {{-- HARGA --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">

                <h3 class="text-lg font-bold text-slate-800 mb-5">
                    Informasi Harga
                </h3>

                <div class="space-y-4">

                    <div class="flex items-center justify-between text-sm">

                        <span class="text-slate-500">
                            Estimasi Harga
                        </span>

                        <span class="font-bold text-slate-800">

                            Rp {{ number_format($order->estimated_price,0,',','.') }}

                        </span>

                    </div>

                    @if($order->final_price)

                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Harga Final
                            </span>

                            <span class="font-bold text-emerald-600">

                                Rp {{ number_format($order->final_price,0,',','.') }}

                            </span>

                        </div>

                    @endif

                    @if($order->dp_amount)

                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                DP
                            </span>

                            <span class="font-bold text-amber-500">

                                {{ $order->dp_percent }}%
                                -
                                Rp {{ number_format($order->dp_amount,0,',','.') }}

                            </span>

                        </div>

                    @endif

                </div>

            </div>

            {{-- PEMBAYARAN --}}
            @if(
                $order->status &&
                $order->status->slug != 'pending'
            )

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">

                    <h3 class="text-lg font-bold text-slate-800 mb-5">
                        Pembayaran
                    </h3>

                    <form
                        action="{{ url('/orders/' . $order->id . '/payment') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="space-y-5"
                    >

                        @csrf

                        <div>

                            <label class="text-sm font-semibold text-slate-600">
                                Jenis Pembayaran
                            </label>

                            <select
                                name="payment_type"
                                id="paymentType"
                                class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm"
                            >

                                <option value="dp">
                                    DP
                                </option>

                                <option value="lunas">
                                    Lunas
                                </option>

                            </select>

                        </div>

                        {{-- BANK --}}
                        <div class="bg-slate-50 rounded-2xl p-4">

                            <p class="text-sm font-semibold text-slate-700">
                                Transfer Ke
                            </p>

                            <div class="mt-3 text-sm text-slate-600 leading-7">

                                BANK BCA
                                <br>

                                1234567890
                                <br>

                                Sahabat Alfino

                            </div>

                        </div>

                        {{-- FILE --}}
                        <div>

                            <label class="text-sm font-semibold text-slate-600">
                                Bukti Pembayaran
                            </label>

                            <input
                                type="file"
                                name="payment_proof"
                                required
                                class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm"
                            >

                        </div>

                        <button
                            type="submit"
                            class="w-full py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold transition"
                        >
                            Kirim Pembayaran
                        </button>

                    </form>

                </div>

            @endif

            {{-- RIWAYAT --}}
            @if($order->payments->count())

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="p-5 border-b border-slate-100">

                        <h3 class="text-lg font-bold text-slate-800">
                            Riwayat Pembayaran
                        </h3>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-slate-50">

                                <tr>

                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Tipe
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Nominal
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-bold text-slate-500 uppercase">
                                        Status
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-slate-100">

                                @foreach($order->payments as $payment)

                                    <tr>

                                        <td class="px-4 py-4 text-sm text-slate-700">

                                            {{ strtoupper($payment->payment_type) }}

                                        </td>

                                        <td class="px-4 py-4 text-sm font-semibold text-slate-800">

                                            Rp {{ number_format($payment->amount,0,',','.') }}

                                        </td>

                                        <td class="px-4 py-4">

                                            <a
                                                href="{{ asset('storage/' . $payment->payment_proof) }}"
                                                target="_blank"
                                                class="px-3 py-1.5 rounded-full bg-sky-100 text-sky-600 text-xs font-semibold"
                                            >
                                                Lihat Bukti
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            @endif

        </div>

    </div>

</section>

@endsection