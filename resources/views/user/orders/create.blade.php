@extends('layouts.app')

@section('content')

<h1>Custom Order</h1>

<hr>

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

<h2>
    {{ $product->name }}
</h2>

<p>
    Harga Dasar:
    Rp {{ number_format($product->base_price) }}
</p>

<hr>

<form action="{{ url('/orders') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <input type="hidden"
           name="product_id"
           value="{{ $product->id }}">

    <h3>Ukuran Custom</h3>

    {{-- PANJANG --}}
    <label>Panjang (cm)</label>
    <br>

    <input type="number"
           name="length"
           value="{{ old('length') }}"
           required>

    <br><br>

    {{-- LEBAR --}}
    <label>Lebar (cm)</label>
    <br>

    <input type="number"
           name="width"
           value="{{ old('width') }}"
           required>

    <br><br>

    {{-- TINGGI --}}
    <label>Tinggi (cm)</label>
    <br>

    <input type="number"
           name="height"
           value="{{ old('height') }}"
           required>

    <br><br>

    {{-- QTY --}}
    <label>Jumlah</label>
    <br>

    <input type="number"
           name="qty"
           min="1"
           value="{{ old('qty', 1) }}">

    <br><br>

    {{-- MATERIAL --}}
    <label>Material</label>
    <br>

    <select name="material_id" required>

        <option value="">
            -- Pilih Material --
        </option>

        @foreach($materials as $material)

            <option value="{{ $material->id }}">

                {{ $material->name }}
                -
                Rp {{ number_format($material->price) }}
                / {{ $material->unit }}

            </option>

        @endforeach

    </select>

    <br><br>

    {{-- ACCESSORIES --}}
    <h3>Accessories</h3>

    @if($accessories->count())

        @foreach($accessories as $accessory)

            <label>

                <input type="checkbox"
                       name="accessories[]"
                       value="{{ $accessory->id }}">

                {{ $accessory->name }}

                -
                Rp {{ number_format($accessory->price) }}

            </label>

            <br>

        @endforeach

    @else

        <p>
            Tidak ada accessories.
        </p>

    @endif

    <br>

    {{-- DESIGN FILE --}}
    <label>Upload Design</label>
    <br>

    <input type="file"
           name="design_file">

    <br><br>

    {{-- NOTES --}}
    <label>Catatan Tambahan</label>
    <br>

    <textarea name="notes">{{ old('notes') }}</textarea>

    <br><br>

    <button type="submit">
        Buat Pesanan
    </button>

</form>

@endsection