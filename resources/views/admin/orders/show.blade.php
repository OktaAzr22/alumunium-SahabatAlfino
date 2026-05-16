@extends('layouts.app')

@section('content')

<h1>Detail Pesanan</h1>

<a href="{{ url('/admin/orders') }}">
    Kembali
</a>

<br><br>

@if(session('success'))

    <div style="color: green;">
        {{ session('success') }}
    </div>

    <br>

@endif

{{-- ========================= --}}
{{-- INFO ORDER --}}
{{-- ========================= --}}
<table border="1" cellpadding="10">

    <tr>
        <td>Kode Order</td>
        <td>{{ $order->code }}</td>
    </tr>

    <tr>
        <td>Customer</td>
        <td>{{ $order->user->name }}</td>
    </tr>

    <tr>
        <td>Status</td>
        <td>
            {{ $order->status->name ?? '-' }}
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

<table border="1" cellpadding="10">

    <tr>
        <td>Produk</td>
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

    <table border="1" cellpadding="10">

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
{{-- FORM UPDATE --}}
{{-- ========================= --}}
<h3>Update Pesanan</h3>

<form action="{{ url('/admin/orders/' . $order->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    {{-- STATUS --}}
    <label>Status</label>
    <br>

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
        <small>
            (cutting, finishing, keuntungan, dll)
        </small>
    </label>

    <br>

    <input type="number"
           name="other_cost"
           value="{{ $order->other_cost ?? 0 }}">

    <br><br>

    {{-- DP PERCENT --}}
<label>DP (%)</label>
<br>

<input type="number"
       name="dp_percent"
       min="0"
       max="100"
       value="{{ old('dp_percent', $order->dp_percent ?? 0) }}">

<small>
    Masukkan persentase DP
</small>

<br><br>

    {{-- ADMIN NOTES --}}
    <label>Catatan Admin</label>
    <br>

    <textarea name="admin_notes">{{ $order->admin_notes }}</textarea>

    <br><br>

    <button type="submit">
        Update Pesanan
    </button>

</form>

<hr>

{{-- ========================= --}}
{{-- RIWAYAT PEMBAYARAN --}}
{{-- ========================= --}}
<h3>Riwayat Pembayaran</h3>

@if($order->payments->count())

    <table border="1" cellpadding="10">

        <tr>
            <th>Tipe</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Bukti</th>
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

            </tr>

        @endforeach

    </table>

@else

    <p>Belum ada pembayaran.</p>

@endif

@endsection