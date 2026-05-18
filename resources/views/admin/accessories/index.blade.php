@extends('layouts.admin')

@section('content')

<h1>Accessories</h1>

<a href="/admin/accessories/create">
    Tambah Accessory
</a>

<br><br>

@if(session('success'))

    <p>{{ session('success') }}</p>

@endif

<table border="1" cellpadding="10">

    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($accessories as $accessory)

    <tr>

        <td>
            {{ $accessory->name }}
        </td>

        <td>
            {{ $accessory->category }}
        </td>

        <td>
            Rp {{ number_format($accessory->price) }}
        </td>

        <td>

            @if($accessory->is_active)

                Aktif

            @else

                Nonaktif

            @endif

        </td>

        <td>

            <a href="/admin/accessories/{{ $accessory->id }}/edit">
                Edit
            </a>

            <form action="/admin/accessories/{{ $accessory->id }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@endsection