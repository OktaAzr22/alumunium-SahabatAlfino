@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto px-4 md:px-6 py-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ url('/admin/orders') }}" class="hover:text-indigo-600">
                    Pesanan
                </a>

                <i class="fas fa-chevron-right text-xs"></i>

                <span class="text-indigo-600 font-medium">
                    Detail Pesanan
                </span>
            </div>

            <h1 class="text-2xl font-bold text-gray-800">
                Detail Pesanan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap pesanan customer
            </p>
        </div>

        <div class="flex flex-wrap gap-3">

            <button onclick="openUpdateModal()"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2">
                <i class="fas fa-edit text-xs"></i>
                Update Pesanan
            </button>

            <a href="{{ url('/admin/orders') }}"
                class="px-5 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl text-sm font-medium text-gray-700 transition flex items-center gap-2">
                <i class="fas fa-arrow-left text-xs"></i>
                Kembali
            </a>

        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- BANNER --}}
    <div class="mb-6 bg-indigo-600 rounded-2xl p-6 text-white">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>
                <p class="text-indigo-200 text-sm mb-1">
                    STATUS PESANAN
                </p>

                <h2 class="text-2xl font-bold mb-2">
                    {{ strtoupper($order->status->name ?? '-') }}
                </h2>

                <p class="text-indigo-100 text-sm max-w-2xl">
                    Pastikan status pesanan selalu diperbarui agar customer dapat memantau proses pengerjaan secara realtime.
                </p>
            </div>

            <div class="bg-white/10 rounded-2xl px-5 py-4 backdrop-blur-sm">
                <p class="text-indigo-200 text-xs mb-1">
                    Dibuat Pada
                </p>

                <h3 class="font-bold text-lg">
                    {{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}
                </h3>

                <p class="text-sm text-indigo-100">
                    {{ $order->created_at ? $order->created_at->format('H:i') : '-' }} WIB
                </p>
            </div>

        </div>
    </div>

    {{-- INFORMASI PESANAN --}}
    <div class="bg-white border border-gray-100 rounded-2xl mb-6 overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">
                Informasi Pesanan
            </h2>
        </div>

        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">
                        Kode Order
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->code }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">
                        Customer
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->user->name }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $order->user->email ?? '-' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">
                        Estimasi Sistem
                    </p>

                    <h3 class="font-bold text-gray-800">
                        Rp {{ number_format($estimatedPrice,0,',','.') }}
                    </h3>
                </div>

                <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4">
                    <p class="text-xs text-indigo-500 mb-1">
                        Harga Final
                    </p>

                    <h3 class="font-bold text-indigo-700 text-lg">
                        Rp {{ number_format($order->final_price ?? 0,0,',','.') }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">
                        Biaya Tambahan
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        Rp {{ number_format($order->other_cost ?? 0,0,',','.') }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">
                        DP
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->dp_percent ?? 0 }}%
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Rp {{ number_format($order->dp_amount ?? 0,0,',','.') }}
                    </p>
                </div>

            </div>

        </div>
    </div>

    {{-- DETAIL PRODUK --}}
    <div class="bg-white border border-gray-100 rounded-2xl mb-6 overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">
                Detail Produk
            </h2>
        </div>

        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Produk
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->detail->product->name ?? '-' }}
                    </h3>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Ukuran
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->detail->length }} x
                        {{ $order->detail->width }} x
                        {{ $order->detail->height }} cm
                    </h3>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Luas
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->detail->area }} m²
                    </h3>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Qty
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->detail->qty }} pcs
                    </h3>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Material
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->detail->material->name ?? '-' }}
                    </h3>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">
                        Kebutuhan Material
                    </p>

                    <h3 class="font-semibold text-gray-800">
                        {{ $order->detail->material_qty }}
                        {{ $order->detail->material->unit ?? '' }}
                    </h3>
                </div>

            </div>

        </div>
    </div>

    {{-- AKSESORIS --}}
    <div class="bg-white border border-gray-100 rounded-2xl mb-6 overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">
                Aksesoris
            </h2>
        </div>

        <div class="overflow-x-auto">

            @if($order->detail->accessories->count())

            <table class="min-w-full">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs text-gray-500 uppercase">
                            Nama
                        </th>

                        <th class="px-6 py-4 text-left text-xs text-gray-500 uppercase">
                            Qty
                        </th>

                        <th class="px-6 py-4 text-left text-xs text-gray-500 uppercase">
                            Harga
                        </th>

                        <th class="px-6 py-4 text-left text-xs text-gray-500 uppercase">
                            Subtotal
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @foreach($order->detail->accessories as $accessory)
                    <tr>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $accessory->name }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $accessory->pivot->qty }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            Rp {{ number_format($accessory->pivot->price,0,',','.') }}
                        </td>

                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                            Rp {{ number_format($accessory->pivot->subtotal,0,',','.') }}
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

            @else

            <div class="p-10 text-center text-gray-500">
                Tidak ada aksesoris.
            </div>

            @endif

        </div>
    </div>

    {{-- PEMBAYARAN --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800">
                Pembayaran
            </h2>
        </div>

        <div class="p-6 space-y-4">

            @forelse($order->payments as $payment)

            @php
                $paymentStatusColor = match($payment->status) {
                    'pending' => 'yellow',
                    'approved' => 'green',
                    'failed' => 'red',
                    default => 'gray'
                };
            @endphp

            <div class="border border-gray-100 rounded-2xl p-5">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>
                        <h3 class="font-semibold text-gray-800 uppercase">
                            {{ $payment->payment_type }}
                        </h3>

                        <p class="text-2xl font-bold text-indigo-700 mt-2">
                            Rp {{ number_format($payment->amount,0,',','.') }}
                        </p>
                    </div>

                    <span class="px-4 py-2 rounded-xl text-sm font-medium bg-{{ $paymentStatusColor }}-100 text-{{ $paymentStatusColor }}-700 w-fit">
                        {{ strtoupper($payment->status) }}
                    </span>

                </div>

                <div class="flex flex-wrap gap-3 mt-5">

                    @if($payment->payment_proof)
                    <a href="{{ asset('storage/' . $payment->payment_proof) }}"
                        target="_blank"
                        class="px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-xl text-sm transition">
                        Lihat Bukti
                    </a>
                    @endif

                    @if($payment->status == 'pending')
                    <form action="{{ url('/admin/payments/' . $payment->id . '/approve') }}"
                        method="POST">
                        @csrf

                        <button type="submit"
                            class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm transition">
                            Konfirmasi Pembayaran
                        </button>
                    </form>
                    @endif

                </div>

            </div>

            @empty

            <div class="text-center py-10 text-gray-500">
                Belum ada pembayaran.
            </div>

            @endforelse

        </div>
    </div>

</div>

{{-- MODAL --}}
<div id="updateModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

    <div class="bg-white w-full max-w-xl rounded-2xl overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-gray-800">
                    Update Pesanan
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update informasi pesanan
                </p>
            </div>

            <button onclick="closeUpdateModal()"
                class="w-10 h-10 rounded-xl hover:bg-gray-100 text-gray-500 transition">
                <i class="fas fa-times"></i>
            </button>

        </div>

        <form action="{{ url('/admin/orders/' . $order->id) }}"
            method="POST"
            class="p-6 space-y-5">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status Pesanan
                </label>

                <select name="status_id"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none">

                    @foreach($statuses as $status)
                    <option value="{{ $status->id }}"
                        @selected($order->status_id == $status->id)>
                        {{ $status->name }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Biaya Lain-lain
                </label>

                <input type="number"
                    name="other_cost"
                    value="{{ $order->other_cost ?? 0 }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    DP (%)
                </label>

                <input type="number"
                    name="dp_percent"
                    value="{{ old('dp_percent', $order->dp_percent ?? 0) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan Admin
                </label>

                <textarea name="admin_notes"
                    rows="4"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none resize-none">{{ $order->admin_notes }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-2">

                <button type="button"
                    onclick="closeUpdateModal()"
                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium text-gray-700 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 rounded-xl text-sm font-medium text-white transition">
                    Simpan Update
                </button>

            </div>

        </form>

    </div>
</div>

<script>
    function openUpdateModal() {
        const modal = document.getElementById('updateModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeUpdateModal() {
        const modal = document.getElementById('updateModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('updateModal');

        if (e.target === modal) {
            closeUpdateModal();
        }
    });
</script>

@endsection