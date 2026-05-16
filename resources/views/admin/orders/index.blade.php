@extends('layouts.app')

@section('content')

<h1>Daftar Order</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">

    <tr>
        <th>Kode</th>
        <th>User</th>
        <th>Produk</th>
        <th>Status</th>
        <th>Total Harga</th>
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
            {{ $order->product->name }}
        </td>

        <td>
            {{ $order->status }}
        </td>

        <td>
            @if($order->total_price)
                Rp {{ number_format($order->total_price) }}
            @else
                -
            @endif
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