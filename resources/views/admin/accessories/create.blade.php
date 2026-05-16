@extends('layouts.app')

@section('content')

<h1>Tambah Accessory</h1>

<form action="/admin/accessories"
      method="POST">

    @csrf

    <label>Nama</label>
    <br>

    <input type="text"
           name="name">

    <br><br>

    <label>Kategori</label>
    <br>

    <input type="text"
           name="category">

    <br><br>

    <label>Harga</label>
    <br>

    <input type="number"
           name="price">

    <br><br>

    <label>

        <input type="checkbox"
               name="is_active"
               checked>

        Aktif

    </label>

    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>

@endsection