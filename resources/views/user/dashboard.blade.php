@extends('layouts.app')

@section('content')
    <h1>User Dashboard</h1>

    <p>Selamat datang, {{ auth()->user()->name }}</p>

    <ul>
        <li>Lihat Produk</li>
        <li>Pesan Produk</li>
        <li>Status Pesanan</li>
    </ul>
@endsection