@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>

    <a href="/admin/products">
            Lihat Produk
    </a>
    <a href="/admin/materials">
            Lihat Material
        </a>

    <ul>
        <li>Kelola Produk</li>
        <li>Kelola Pesanan</li>
        <li>Update Status Order</li>
    </ul>
@endsection