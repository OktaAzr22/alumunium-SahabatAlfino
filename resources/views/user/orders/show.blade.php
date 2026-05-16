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
        {{ strtoupper($order->status) }}
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

@endsection