@extends('layouts.app')

@section('content')

<h1>Detail Pesanan</h1>

<a href="{{ url('/admin/orders') }}">
    ← Kembali
</a>

<br><br>

@if(session('success'))

    <div style="
        padding:10px;
        border:1px solid green;
        color:green;
        margin-bottom:20px;
    ">
        {{ session('success') }}
    </div>

@endif

{{-- ========================= --}}
{{-- INFO ORDER --}}
{{-- ========================= --}}
<h3>Informasi Pesanan</h3>

<table border="1" cellpadding="10" width="100%">

    <tr>
        <td width="220">Kode Order</td>
        <td>{{ $order->code }}</td>
    </tr>

    <tr>
        <td>Customer</td>
        <td>{{ $order->user->name }}</td>
    </tr>

    <tr>
        <td>Status</td>
        <td>
            <strong>
                {{ $order->status->name ?? '-' }}
            </strong>
        </td>
    </tr>

    <tr>
        <td>Estimasi Sistem</td>
        <td>
            Rp {{ number_format($estimatedPrice) }}
        </td>
    </tr>

    <tr>
        <td>Biaya Lain-lain</td>
        <td>
            Rp {{ number_format($order->other_cost ?? 0) }}
        </td>
    </tr>

    <tr>
        <td>Harga Final</td>
        <td>
            <strong>
                Rp {{ number_format($order->final_price ?? 0) }}
            </strong>
        </td>
    </tr>

    <tr>
        <td>DP</td>
        <td>

            {{ $order->dp_percent ?? 0 }}%

            <br>

            Rp {{ number_format($order->dp_amount ?? 0) }}

        </td>
    </tr>

</table>

<br>

{{-- ========================= --}}
{{-- DETAIL PRODUK --}}
{{-- ========================= --}}
<h3>Detail Produk</h3>

<table border="1" cellpadding="10" width="100%">

    <tr>
        <td width="220">Produk</td>
        <td>
            {{ $order->detail->product->name }}
        </td>
    </tr>

    <tr>
        <td>Ukuran</td>
        <td>
            {{ $order->detail->length }} cm x
            {{ $order->detail->width }} cm x
            {{ $order->detail->height }} cm
        </td>
    </tr>

    <tr>
        <td>Luas</td>
        <td>
            {{ $order->detail->area }} m²
        </td>
    </tr>

    <tr>
        <td>Qty</td>
        <td>
            {{ $order->detail->qty }}
        </td>
    </tr>

    <tr>
        <td>Material</td>
        <td>
            {{ $order->detail->material->name }}
        </td>
    </tr>

    <tr>
        <td>Kebutuhan Material</td>
        <td>
            {{ $order->detail->material_qty }}
            {{ $order->detail->material->unit }}
        </td>
    </tr>

    <tr>
        <td>Subtotal Produk</td>
        <td>
            Rp {{ number_format($order->detail->subtotal) }}
        </td>
    </tr>

</table>

<br>

{{-- ========================= --}}
{{-- AKSESORIS --}}
{{-- ========================= --}}
<h3>Aksesoris</h3>

@if($order->detail->accessories->count())

    <table border="1" cellpadding="10" width="100%">

        <tr>
            <th>Nama</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>

        @foreach($order->detail->accessories as $accessory)

            <tr>

                <td>
                    {{ $accessory->name }}
                </td>

                <td>
                    {{ $accessory->pivot->qty }}
                </td>

                <td>
                    Rp {{ number_format($accessory->pivot->price) }}
                </td>

                <td>
                    Rp {{ number_format($accessory->pivot->subtotal) }}
                </td>

            </tr>

        @endforeach

        <tr>

            <td colspan="3">
                <strong>Total Aksesoris</strong>
            </td>

            <td>
                <strong>
                    Rp {{ number_format($accessoriesTotal) }}
                </strong>
            </td>

        </tr>

    </table>

@else

    <p>Tidak ada aksesoris.</p>

@endif

<br>

{{-- ========================= --}}
{{-- PEMBAYARAN --}}
{{-- ========================= --}}
<h3>Riwayat Pembayaran</h3>

@if($order->payments->count())

    <table border="1" cellpadding="10" width="100%">

        <tr>
            <th>Tipe</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>

        @foreach($order->payments as $payment)

            <tr>

                <td>
                    {{ strtoupper($payment->payment_type) }}
                </td>

                <td>
                    Rp {{ number_format($payment->amount) }}
                </td>

                <td>
                    {{ strtoupper($payment->status) }}
                </td>

                <td>

                    @if($payment->payment_proof)

                        <a href="{{ asset('storage/' . $payment->payment_proof) }}"
                           target="_blank">

                            Lihat Bukti

                        </a>

                    @else

                        -

                    @endif

                </td>

                <td>

                    @if($payment->status == 'pending')

                        <form action="{{ url('/admin/payments/' . $payment->id . '/approve') }}"
                              method="POST">

                            @csrf

                            <button type="submit">

                                Konfirmasi

                            </button>

                        </form>

                    @else

                        -

                    @endif

                </td>

            </tr>

        @endforeach

    </table>

@else

    <p>Belum ada pembayaran.</p>

@endif

<br>

{{-- ========================= --}}
{{-- FORM UPDATE --}}
{{-- ========================= --}}
<h3>Update Pesanan</h3>

<form action="{{ url('/admin/orders/' . $order->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    {{-- STATUS --}}
    <label>Status</label>

    <br><br>

    <select name="status_id">

        @foreach($statuses as $status)

            <option
                value="{{ $status->id }}"
                @selected($order->status_id == $status->id)
            >
                {{ $status->name }}
            </option>

        @endforeach

    </select>

    <br><br>

    {{-- BIAYA LAIN --}}
    <label>
        Biaya Lain-lain
    </label>

    <br><br>

    <input type="number"
           name="other_cost"
           value="{{ $order->other_cost ?? 0 }}">

    <br><br>

    {{-- DP --}}
    <label>DP (%)</label>

    <br><br>

    <input type="number"
           name="dp_percent"
           min="0"
           max="100"
           value="{{ old('dp_percent', $order->dp_percent ?? 0) }}">

    <br>

    <small>
        Persentase DP dari harga final
    </small>

    <br><br>

    {{-- NOTES --}}
    <label>Catatan Admin</label>

    <br><br>

    <textarea name="admin_notes"
              rows="5"
              style="width:100%;">{{ $order->admin_notes }}</textarea>

    <br><br>

    <button type="submit">
        Update Pesanan
    </button>

</form>

@endsection