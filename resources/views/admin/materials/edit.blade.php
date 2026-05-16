@extends('layouts.app')

@section('content')

<h1>Edit Material</h1>

<form action="/admin/materials/{{ $material->id }}"
      method="POST">

    @csrf
    @method('PUT')

    <label>Nama Material</label>
    <br>

    <input type="text"
           name="name"
           value="{{ $material->name }}">

    <br><br>

    <label>Harga Tambahan</label>
    <br>

    <input type="number"
           name="price"
           value="{{ $material->price }}">

    <br><br>

    <label>Deskripsi</label>
    <br>

    <textarea name="description">{{ $material->description }}</textarea>

    <br><br>

    <label>

        <input type="checkbox"
               name="is_active"

               @checked($material->is_active)>

        Aktif

    </label>

    <br><br>

    <button type="submit">
        Update
    </button>

</form>

@endsection