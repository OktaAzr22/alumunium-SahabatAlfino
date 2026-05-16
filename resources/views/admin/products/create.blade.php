@extends('layouts.app')

@section('content')

<h1>Tambah Produk</h1>

@if ($errors->any())

    <div style="color:red; margin-bottom:20px;">

        <strong>Terjadi kesalahan:</strong>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<form action="{{ url('/admin/products') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    {{-- NAMA --}}
    <label>Nama Produk *</label>
    <br>

    <input type="text"
           name="name"
           value="{{ old('name') }}"
           required>

    <br><br>

    {{-- DESKRIPSI --}}
    <label>Deskripsi</label>
    <br>

    <textarea name="description">{{ old('description') }}</textarea>

    <br><br>

    {{-- HARGA --}}
    <label>Harga Dasar *</label>
    <br>

    <input type="number"
           name="base_price"
           value="{{ old('base_price') }}"
           required>

    <br><br>

    <hr>

    <h3>Ukuran Standar Produk</h3>

    {{-- PANJANG --}}
    <label>Panjang Standar (cm)</label>
    <br>

    <input type="number"
           name="standard_length"
           value="{{ old('standard_length') }}">

    <br><br>

    {{-- LEBAR --}}
    <label>Lebar Standar (cm)</label>
    <br>

    <input type="number"
           name="standard_width"
           value="{{ old('standard_width') }}">

    <br><br>

    {{-- TINGGI --}}
    <label>Tinggi Standar (cm)</label>
    <br>

    <input type="number"
           name="standard_height"
           value="{{ old('standard_height') }}">

    <br><br>

    {{-- FRAME MULTIPLIER --}}
    <label>Frame Multiplier</label>
    <br>

    <input type="number"
           step="0.1"
           name="frame_multiplier"
           value="{{ old('frame_multiplier', 2) }}">

    <small>

        Semakin besar semakin banyak kebutuhan material

    </small>

    <br><br>

    {{-- IMAGE --}}
    <label>Image</label>
    <br>

    <input type="file"
           name="image">

    <br><br>

    <button type="submit">

        Simpan

    </button>

</form>

@endsection