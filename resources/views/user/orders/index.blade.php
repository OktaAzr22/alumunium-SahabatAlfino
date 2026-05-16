@extends('layouts.app')

@section('content')

<h1>Pesanan Saya</h1>

<hr>

@if(session('success'))

    <div style="color:green;">
        {{ session('success') }}
    </div>

    <br>

@endif

@if($orders->count() == 0)

    <p>
        Belum ada pesanan.
    </p>

@endif

@foreach($orders as $order)

    <div style="margin-bottom:30px;">

        <h3>
            {{ $order->code }}
        </h3>

        <p>

            Status:

            <strong>
                {{ strtoupper($order->status) }}
            </strong>

        </p>

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

        <a href="{{ url('/my-orders/' . $order->id) }}">
            Lihat Detail
        </a>

    </div>

    <hr>

@endforeach

@endsection