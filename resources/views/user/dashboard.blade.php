@extends('layouts.app')

@section('content')
    <h1>User Dashboard</h1>

    <p>Selamat datang, {{ auth()->user()->name }}</p>

    <hr>

<h3>Menu</h3>

<ul>

    <li>

        <a href="/products">
            Lihat Produk
        </a>

    </li>

    <li>

        <a href="/my-orders">
            Pesanan Saya
        </a>

    </li>

</ul>

<hr>

<h3>Informasi</h3>

<p>
    Di sini user dapat:
</p>

<ul>

    <li>Melihat katalog produk</li>

    <li>Melakukan custom pemesanan</li>

    <li>Upload design sendiri</li>

    <li>Memantau status pengerjaan</li>

</ul>

@endsection