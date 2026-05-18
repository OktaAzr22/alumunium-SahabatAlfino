@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-red-50 p-4 md:p-6">

    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    Detail Pesanan
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap pesanan customer
                </p>
            </div>

            <div class="flex items-center gap-3">

                <button onclick="openUpdateModal()"
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition">
                    Update Pesanan
                </button>

                <a href="{{ url('/admin/orders') }}"
                   class="px-5 py-2.5 border border-gray-300 bg-white hover:bg-gray-100 rounded-xl text-sm font-medium transition text-gray-700">
                    Kembali
                </a>

            </div>

        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl text-sm">
            {{ session('success') }}
        </div>
        @endif

        <!-- GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT -->
            <div class="lg:col-span-2 space-y-6">

                <!-- INFORMASI -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-800">
                            Informasi Pesanan
                        </h2>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Kode Order
                            </p>

                            <h3 class="font-semibold text-gray-800">
                                {{ $order->code }}
                            </h3>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Customer
                            </p>

                            <h3 class="font-semibold text-gray-800">
                                {{ $order->user->name ?? '-' }}
                            </h3>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Status
                            </p>

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                {{ $order->status->name ?? '-' }}
                            </span>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Estimasi
                            </p>

                            <h3 class="font-bold text-gray-800 whitespace-nowrap">
                                Rp {{ number_format($estimatedPrice,0,',','.') }}
                            </h3>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Harga Final
                            </p>

                            <h3 class="font-bold text-indigo-700 whitespace-nowrap">
                                Rp {{ number_format($order->final_price ?? 0,0,',','.') }}
                            </h3>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                DP
                            </p>

                            <h3 class="font-semibold text-gray-800 whitespace-nowrap">
                                {{ $order->dp_percent ?? 0 }}% - Rp {{ number_format($order->dp_amount ?? 0,0,',','.') }}
                            </h3>
                        </div>

                    </div>

                </div>

                <!-- PRODUK -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-800">
                            Detail Produk
                        </h2>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Produk
                            </p>

                            <h3 class="font-semibold text-gray-800">
                                {{ $order->detail->product->name ?? '-' }}
                            </h3>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Material
                            </p>

                            <h3 class="font-semibold text-gray-800">
                                {{ $order->detail->material->name ?? '-' }}
                            </h3>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Ukuran
                            </p>

                            <h3 class="font-semibold text-gray-800">
                                {{ $order->detail->length ?? 0 }} x {{ $order->detail->width ?? 0 }} x {{ $order->detail->height ?? 0 }} cm
                            </h3>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 mb-1 uppercase">
                                Qty
                            </p>

                            <h3 class="font-semibold text-gray-800">
                                {{ $order->detail->qty ?? 0 }} pcs
                            </h3>
                        </div>

                    </div>

                </div>

                <!-- PEMBAYARAN -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-800">
                            Pembayaran
                        </h2>
                    </div>

                    <div class="p-6 space-y-4">

                        @forelse($order->payments as $payment)

                        <div class="border border-gray-100 rounded-2xl p-5 bg-gray-50">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                <div>
                                    <h3 class="font-bold text-gray-800 uppercase">
                                        {{ $payment->payment_type }}
                                    </h3>

                                    <p class="text-indigo-700 font-bold text-xl mt-2 whitespace-nowrap">
                                        Rp {{ number_format($payment->amount,0,',','.') }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold uppercase">
                                    {{ $payment->status }}
                                </span>

                            </div>

                            <div class="flex flex-wrap items-center gap-3 mt-5">

                                @if($payment->payment_proof)
                                <a href="{{ asset('storage/' . $payment->payment_proof) }}"
                                   target="_blank"
                                   class="px-4 py-2 rounded-xl bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-sm font-medium transition">
                                    Lihat Bukti
                                </a>
                                @endif

                                @if($payment->status == 'pending')
                                <form action="{{ url('/admin/payments/' . $payment->id . '/approve') }}"
                                      method="POST">
                                    @csrf

                                    <button type="submit"
                                            class="px-4 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                                        Konfirmasi
                                    </button>
                                </form>
                                @endif

                            </div>

                        </div>

                        @empty

                        <div class="text-center py-12 text-gray-500 text-sm">
                            Belum ada pembayaran
                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden sticky top-5">

                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-800">
                            Catatan Admin
                        </h2>
                    </div>

                    <div class="p-6">
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $order->admin_notes ?? 'Belum ada catatan admin.' }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- MODAL -->
<div id="updateModal"
     class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center p-4">

    @php
        $lockedStatuses = [
            'dp_dicek',
            'diproses',
            'menunggu_pelunasan',
            'pelunasan_dicek',
            'lunas',
            'selesai',
            'siap_diambil',
            'dikirim'
        ];

        $isLocked = in_array(
            $order->status->slug ?? '',
            $lockedStatuses
        );

        $blockedStatuses = [
        'pending',
        'menunggu_konfirmasi',
        'menunggu_konfirmasi_pembayaran',
        'menunggu_dp'
    ];
    @endphp

    <div class="bg-white rounded-2xl w-full max-w-xl overflow-hidden shadow-xl">

        <!-- HEADER -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">

            <h2 class="font-bold text-gray-800 text-lg">
                Update Pesanan
            </h2>

            <button onclick="closeUpdateModal()"
                    type="button"
                    class="w-10 h-10 rounded-xl hover:bg-gray-100 text-gray-500 transition">
                <i class="fas fa-times"></i>
            </button>

        </div>

        <!-- FORM -->
        <form action="{{ url('/admin/orders/' . $order->id) }}"
              method="POST"
              class="p-6 space-y-5">

            @csrf
            @method('PUT')

            <!-- STATUS -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status
                </label>

               <select name="status_id"
        class="w-full px-4 py-3 rounded-xl border border-gray-300 outline-none focus:ring-2 focus:ring-indigo-200">

    @foreach($statuses as $status)

        <option value="{{ $status->id }}"
            @selected($order->status_id == $status->id)

            @if(
                $isLocked &&
                in_array($status->slug, $blockedStatuses)
            )
                disabled
            @endif>

            {{ $status->name }}

            @if(
                $isLocked &&
                in_array($status->slug, $blockedStatuses)
            )
                (Tidak tersedia)
            @endif

        </option>

    @endforeach

</select>

            </div>

            <!-- BIAYA LAIN -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Biaya Lain-lain
                </label>

                <input type="number"
                       name="other_cost"
                       value="{{ $order->other_cost ?? 0 }}"
                       @readonly($isLocked)
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 outline-none
                              {{ $isLocked
                                  ? 'bg-gray-100 text-gray-500 cursor-not-allowed'
                                  : 'focus:ring-2 focus:ring-indigo-200 bg-white'
                              }}">

            </div>

            <!-- DP -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    DP (%)
                </label>

                <input type="number"
                       name="dp_percent"
                       value="{{ $order->dp_percent ?? 0 }}"
                       @readonly($isLocked)
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 outline-none
                              {{ $isLocked
                                  ? 'bg-gray-100 text-gray-500 cursor-not-allowed'
                                  : 'focus:ring-2 focus:ring-indigo-200 bg-white'
                              }}">

            </div>

            <!-- CATATAN ADMIN -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Catatan Admin
                </label>

                <textarea name="admin_notes"
                          rows="4"
                          @readonly($isLocked)
                          class="w-full px-4 py-3 rounded-xl border border-gray-300 resize-none outline-none
                                 {{ $isLocked
                                     ? 'bg-gray-100 text-gray-500 cursor-not-allowed'
                                     : 'focus:ring-2 focus:ring-indigo-200 bg-white'
                                 }}">{{ $order->admin_notes }}</textarea>

            </div>

            <!-- INFO LOCK -->
            @if($isLocked)

                <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 text-sm rounded-xl px-4 py-3">

                    Data biaya dan DP sudah dikunci karena pesanan sudah masuk tahap pembayaran/proses.

                </div>

            @endif

            <!-- BUTTON -->
            <div class="flex items-center justify-end gap-3">

                <button type="button"
                        onclick="closeUpdateModal()"
                        class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">

                    Batal

                </button>

                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    function openUpdateModal() {
        document.getElementById('updateModal').classList.remove('hidden');
        document.getElementById('updateModal').classList.add('flex');
    }

    function closeUpdateModal() {
        document.getElementById('updateModal').classList.add('hidden');
        document.getElementById('updateModal').classList.remove('flex');
    }
</script>
@endsection