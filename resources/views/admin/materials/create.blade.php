@extends('layouts.app')

@section('content')

<h1>Tambah Material</h1>

<form action="/admin/materials"
      method="POST">

    @csrf

    <label>Nama Material</label>
    <br>

    <input type="text"
           name="name">

    <br><br>

    <label>Harga Tambahan</label>
    <br>

    <input type="number"
           name="price">

    <br><br>

    <label>Satuan</label>

<select name="unit">

    <option value="meter">
        Meter
    </option>

    <option value="cm">
        CM
    </option>

    <option value="pcs">
        PCS
    </option>

    <option value="lembar">
        Lembar
    </option>

</select>

    <label>Deskripsi</label>
    <br>

    <textarea name="description"></textarea>

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