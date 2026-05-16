@extends('layouts.app')

@section('content')

<h1>Katalog Produk</h1>

<hr>

@if(session('success'))

    <div style="color:green;">

        {{ session('success') }}

    </div>

    <br>

@endif

@if($products->count() == 0)

    <p>
        Produk belum tersedia.
    </p>

@endif

@foreach($products as $product)

    <div style="margin-bottom:30px;">

        {{-- IMAGE --}}
        @if($product->image)

            <img
                src="{{ asset('storage/' . $product->image) }}"
                width="200">

            <br><br>

        @endif

        {{-- NAMA --}}
        <h3>
            {{ $product->name }}
        </h3>

        {{-- DESKRIPSI --}}
        <p>
            {{ $product->description }}
        </p>

        {{-- HARGA --}}
        <p>

            Harga mulai dari:

            <strong>

                Rp {{ number_format($product->base_price) }}

            </strong>

        </p>

        {{-- BUTTON DETAIL --}}
        <a href="{{ url('/products/' . $product->id) }}">

            Lihat Detail

        </a>

    </div>

    <hr>

@endforeach

@endsection