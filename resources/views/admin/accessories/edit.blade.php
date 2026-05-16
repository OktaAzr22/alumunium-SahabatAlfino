@extends('layouts.app')

@section('content')

<h1>Edit Accessory</h1>

<form action="/admin/accessories/{{ $accessory->id }}"
      method="POST">

    @csrf
    @method('PUT')

    <label>Nama</label>
    <br>

    <input type="text"
           name="name"
           value="{{ $accessory->name }}">

    <br><br>

    <label>Kategori</label>
    <br>

    <input type="text"
           name="category"
           value="{{ $accessory->category }}">

    <br><br>

    <label>Harga</label>
    <br>

    <input type="number"
           name="price"
           value="{{ $accessory->price }}">

    <br><br>

    <label>

        <input type="checkbox"
               name="is_active"

               @checked($accessory->is_active)>

        Aktif

    </label>

    <br><br>

    <button type="submit">
        Update
    </button>

</form>

@endsection