@section('content')
@extends('layouts.app')

<table border="1" cellpadding="10">

    <tr>

        <th>Kode</th>

        <th>Customer</th>

        <th>Produk</th>

        <th>Status</th>

        <th>Estimasi</th>

        <th>Harga Final</th>

        <th>Aksi</th>

    </tr>

    @foreach($orders as $order)

        <tr>

            <td>
                {{ $order->code }}
            </td>

            <td>
                {{ $order->user->name }}
            </td>

            <td>
                {{ $order->detail->product->name }}
            </td>

            <td>
                {{ strtoupper($order->status) }}
            </td>

            <td>
                Rp {{ number_format($order->estimated_price) }}
            </td>

            <td>
                Rp {{ number_format($order->final_price) }}
            </td>

            <td>

                <a href="/admin/orders/{{ $order->id }}">
                    Detail
                </a>

            </td>

        </tr>

    @endforeach

</table>

@endsection