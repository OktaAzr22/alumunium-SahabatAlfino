@extends('layouts.app')

@section('content')

<h1>
    {{ $product->name }}
</h1>

<hr>

{{-- IMAGE --}}
@if($product->image)

    <img
        src="{{ asset('storage/' . $product->image) }}"
        width="300">

    <br><br>

@endif

{{-- DESKRIPSI --}}
<p>
    {{ $product->description }}
</p>

<hr>

{{-- HARGA --}}
<h3>Harga Dasar</h3>

<p>

    Rp {{ number_format($product->base_price) }}

</p>

<hr>

{{-- UKURAN STANDAR --}}
@if(
    $product->standard_length &&
    $product->standard_width &&
    $product->standard_height
)

    <h3>Ukuran Standar</h3>

    <p>

        {{ $product->standard_length }}
        x
        {{ $product->standard_width }}
        x
        {{ $product->standard_height }}
        cm

    </p>

    <hr>

@endif

{{-- BUTTON ORDER --}}
<a href="{{ url('/orders/create?product=' . $product->id) }}">

    <button>

        Pesan Sekarang

    </button>

</a>

@endsection