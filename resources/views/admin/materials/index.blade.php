@extends('layouts.admin')

@section('content')

<h1>Materials</h1>

<a href="/admin/materials/create">
    Tambah Material
</a>

<br><br>

@if(session('success'))

    <p>{{ session('success') }}</p>

@endif

<table border="1" cellpadding="10">

    <tr>

        <th>Nama</th>

        <th>Harga</th>

        <th>Status</th>

        <th>Aksi</th>

    </tr>

    @foreach($materials as $material)

    <tr>

        <td>
            {{ $material->name }}
        </td>

        <td>
            Rp {{ number_format($material->price) }}
        </td>

        <td>

            @if($material->is_active)

                Aktif

            @else

                Nonaktif

            @endif

        </td>

        <td>

            <a href="/admin/materials/{{ $material->id }}/edit">
                Edit
            </a>

            <form action="/admin/materials/{{ $material->id }}"
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