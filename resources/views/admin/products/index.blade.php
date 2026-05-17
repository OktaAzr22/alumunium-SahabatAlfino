@extends('layouts.admin')

@section('content')

<h1>Data Produk</h1>

<a href="{{ url('/admin/products/create') }}">

    Tambah Produk

</a>

<br><br>

@if(session('success'))

    <div style="color:green;">

        {{ session('success') }}

    </div>

    <br>

@endif

<table border="1" cellpadding="10">

    <tr>

        <th>Image</th>

        <th>Nama</th>

        <th>Harga Dasar</th>

        <th>Ukuran Standar</th>

        <th>Frame Multiplier</th>

        <th>Deskripsi</th>

        <th>Aksi</th>

    </tr>

    @foreach($products as $product)

        <tr>

            {{-- IMAGE --}}
            <td>

                @if($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        width="80">

                @else

                    Tidak ada gambar

                @endif

            </td>

            {{-- NAMA --}}
            <td>

                {{ $product->name }}

            </td>

            {{-- HARGA --}}
            <td>

                Rp {{ number_format($product->base_price) }}

            </td>

            {{-- UKURAN --}}
            <td>

                @if(
                    $product->standard_length &&
                    $product->standard_width &&
                    $product->standard_height
                )

                    {{ $product->standard_length }}
                    x
                    {{ $product->standard_width }}
                    x
                    {{ $product->standard_height }}
                    cm

                @else

                    -

                @endif

            </td>

            {{-- MULTIPLIER --}}
            <td>

                {{ $product->frame_multiplier }}

            </td>

            {{-- DESKRIPSI --}}
            <td>

                {{ $product->description }}

            </td>

            {{-- AKSI --}}
            <td>

                <a href="{{ url('/admin/products/' . $product->id . '/edit') }}">

                    Edit

                </a>

                <br><br>

                <form action="{{ url('/admin/products/' . $product->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Hapus produk ini?')">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

    @endforeach

</table>

@endsection