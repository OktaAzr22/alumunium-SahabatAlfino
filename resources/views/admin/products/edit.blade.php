@extends('layouts.app')

@section('content')

<h1>Edit Produk</h1>

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

<form action="{{ url('/admin/products/' . $product->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- NAMA --}}
    <label>Nama Produk *</label>
    <br>

    <input type="text"
           name="name"
           value="{{ old('name', $product->name) }}">

    @error('name')

        <div style="color:red;">
            {{ $message }}
        </div>

    @enderror

    <br><br>

    {{-- DESKRIPSI --}}
    <label>Deskripsi</label>
    <br>

    <textarea name="description">{{ old('description', $product->description) }}</textarea>

    @error('description')

        <div style="color:red;">
            {{ $message }}
        </div>

    @enderror

    <br><br>

    {{-- BASE PRICE --}}
    <label>Base Price *</label>
    <br>

    <input type="number"
           name="base_price"
           value="{{ old('base_price', $product->base_price) }}">

    @error('base_price')

        <div style="color:red;">
            {{ $message }}
        </div>

    @enderror

    <br><br>

    {{-- IMAGE --}}
    <label>Image</label>
    <br>

    <input type="file"
           name="image">

    @error('image')

        <div style="color:red;">
            {{ $message }}
        </div>

    @enderror

    <br><br>

    @if($product->image)

        <img src="{{ $product->image_url }}"
             width="120">

        <br><br>

    @endif

    <button type="submit">
        Update
    </button>

</form>

@endsection