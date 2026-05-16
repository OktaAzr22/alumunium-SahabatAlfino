@extends('layouts.app')

@section('content')

<h1>Detail Pesanan</h1>

<hr>

<h2>
    {{ $order->code }}
</h2>

<p>

    Status:

    <strong>
        {{ $order->status->name ?? '-' }}
    </strong>

</p>

<p>

    Tanggal Pesanan:
    {{ $order->created_at->format('d M Y') }}

</p>

<hr>

<h3>Produk</h3>

<p>
    {{ $order->detail->product->name }}
</p>

@if($order->detail->product->image)

    <img
        src="{{ asset('storage/' . $order->detail->product->image) }}"
        width="200">

    <br><br>

@endif

<hr>

<h3>Ukuran Custom</h3>

<p>

    {{ $order->detail->length }}
    x
    {{ $order->detail->width }}
    x
    {{ $order->detail->height }}
    cm

</p>

<hr>

<h3>Material</h3>

<p>

    {{ $order->detail->material->name }}

</p>

<p>

    Kebutuhan Material:

    {{ $order->detail->material_qty }}

    {{ $order->detail->material->unit }}

</p>

<hr>

<h3>Accessories</h3>

@if($order->detail->accessories->count())

    <ul>

        @foreach($order->detail->accessories as $accessory)

            <li>

                {{ $accessory->name }}

                ({{ $accessory->pivot->qty }}x)

                -

                Rp
                {{ number_format($accessory->pivot->subtotal) }}

            </li>

        @endforeach

    </ul>

@else

    <p>
        Tidak ada accessories
    </p>

@endif

<hr>

<h3>Harga</h3>

<p>

    Estimasi Harga:
    Rp {{ number_format($order->estimated_price) }}

</p>

@if($order->final_price)

    <p>

        Harga Final:
        Rp {{ number_format($order->final_price) }}

    </p>

@endif

@if($order->dp_amount)

    <p>

        DP:

        {{ $order->dp_percent }}%

        -

        Rp {{ number_format($order->dp_amount) }}

    </p>

@endif

<hr>

<h3>Catatan Tambahan</h3>

<p>
    {{ $order->detail->notes ?? '-' }}
</p>

<hr>

<h3>Catatan Admin</h3>

<p>
    {{ $order->admin_notes ?? '-' }}
</p>

@if($order->design_file)

    <hr>

    <h3>File Design</h3>

    <a href="{{ asset('storage/' . $order->design_file) }}"
       target="_blank">

        Lihat File Design

    </a>

@endif

{{-- ========================= --}}
{{-- FORM PEMBAYARAN --}}
{{-- ========================= --}}
@if(
    $order->status &&
    $order->status->slug != 'pending'
)

    <hr>

    <h3>Pembayaran</h3>

    @if(session('success'))

        <div style="color: green;">
            {{ session('success') }}
        </div>

        <br>

    @endif

    <form action="{{ url('/orders/' . $order->id . '/payment') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        {{-- TIPE PEMBAYARAN --}}
        <label>Pilih Pembayaran</label>

        <br>

        <select name="payment_type"
                id="paymentType">

            <option value="dp">

                DP

            </option>

            <option value="lunas">

                Lunas

            </option>

        </select>

        <br><br>

        {{-- INFO DP --}}
        <div id="dpInfo">

            <p>

                DP:

                {{ $order->dp_percent }}%

            </p>

            <p>

                Nominal DP:

                Rp {{ number_format($order->dp_amount) }}

            </p>

        </div>

        {{-- INFO LUNAS --}}
        <div id="lunasInfo"
             style="display:none;">

            <p>

                Total Pelunasan:

                Rp {{ number_format($order->final_price) }}

            </p>

        </div>

        <hr>

        <h4>Transfer Ke</h4>

        <p>

            BANK BCA
            <br>

            1234567890
            <br>

            Sahabat Alfino

        </p>

        <hr>

        {{-- BUKTI --}}
        <label>Bukti Pembayaran</label>

        <br>

        <input type="file"
               name="payment_proof"
               required>

        <br><br>

        <button type="submit">

            Kirim Pembayaran

        </button>

    </form>

    <script>

        const paymentType =
            document.getElementById('paymentType');

        const dpInfo =
            document.getElementById('dpInfo');

        const lunasInfo =
            document.getElementById('lunasInfo');

        paymentType.addEventListener(
            'change',
            function () {

                if (this.value === 'dp') {

                    dpInfo.style.display = 'block';
                    lunasInfo.style.display = 'none';

                } else {

                    dpInfo.style.display = 'none';
                    lunasInfo.style.display = 'block';
                }
            }
        );

    </script>

@endif

{{-- ========================= --}}
{{-- RIWAYAT PEMBAYARAN --}}
{{-- ========================= --}}
@if($order->payments->count())

    <hr>

    <h3>Riwayat Pembayaran</h3>

    <table border="1"
           cellpadding="10">

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

                    <a href="{{ asset('storage/' . $payment->payment_proof) }}"
                       target="_blank">

                        Lihat Bukti

                    </a>

                </td>

            </tr>

        @endforeach

    </table>

@endif

@endsection