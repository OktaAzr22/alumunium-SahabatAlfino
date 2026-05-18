@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4 md:px-6">

    <div class="max-w-3xl mx-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Edit Produk
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Update informasi produk
                </p>

            </div>

            <a href="{{ url('/admin/products') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl text-sm font-medium text-gray-700 transition">

                <i class="fas fa-arrow-left text-xs"></i>

                Kembali

            </a>

        </div>

        <!-- ERROR -->
        @if ($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-5">

            <div class="flex items-start gap-3">

                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">

                    <i class="fas fa-exclamation-circle"></i>

                </div>

                <div>

                    <h3 class="font-semibold text-red-700 mb-2">
                        Terjadi Kesalahan
                    </h3>

                    <ul class="list-disc ml-5 text-sm text-red-600 space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

        @endif

        <!-- FORM -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- TOP -->
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">

                <h2 class="font-semibold text-gray-800">
                    Form Edit Produk
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Lengkapi data produk dengan benar
                </p>

            </div>

            <!-- BODY -->
            <form action="{{ url('/admin/products/' . $product->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 space-y-6">

                @csrf
                @method('PUT')

                <!-- IMAGE -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Gambar Produk
                    </label>

                    <div class="flex flex-col md:flex-row gap-5 items-start">

                        <!-- PREVIEW -->
                        <div class="w-36 h-36 rounded-2xl border border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center">

                            @if($product->image)

                                <img src="{{ $product->image_url }}"
                                     class="w-full h-full object-cover">

                            @else

                                <div class="text-center text-gray-400">

                                    <i class="fas fa-image text-3xl mb-2"></i>

                                    <p class="text-xs">
                                        Tidak ada gambar
                                    </p>

                                </div>

                            @endif

                        </div>

                        <!-- INPUT -->
                        <div class="flex-1">

                            <label class="w-full flex flex-col items-center justify-center border-2 border-dashed border-gray-300 hover:border-indigo-400 rounded-2xl px-6 py-8 cursor-pointer transition bg-gray-50 hover:bg-indigo-50">

                                <div class="w-14 h-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-3">

                                    <i class="fas fa-cloud-upload-alt text-xl"></i>

                                </div>

                                <h3 class="font-semibold text-gray-700">
                                    Upload Gambar Baru
                                </h3>

                                <p class="text-sm text-gray-500 mt-1 text-center">
                                    PNG, JPG, JPEG maksimal 2MB
                                </p>

                                <input type="file"
                                       name="image"
                                       class="hidden">

                            </label>

                            @error('image')

                                <p class="text-sm text-red-500 mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>

                <!-- NAMA -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Produk
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $product->name) }}"
                           placeholder="Masukkan nama produk"
                           class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none transition">

                    @error('name')

                        <p class="text-sm text-red-500 mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                <!-- HARGA -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Base Price
                    </label>

                    <div class="relative">

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                            Rp
                        </span>

                        <input type="number"
                               name="base_price"
                               value="{{ old('base_price', $product->base_price) }}"
                               placeholder="0"
                               class="w-full pl-12 pr-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none transition">

                    </div>

                    @error('base_price')

                        <p class="text-sm text-red-500 mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                <!-- DESKRIPSI -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>

                    <textarea name="description"
                              rows="5"
                              placeholder="Masukkan deskripsi produk..."
                              class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none transition resize-none">{{ old('description', $product->description) }}</textarea>

                    @error('description')

                        <p class="text-sm text-red-500 mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                <!-- BUTTON -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">

                    <a href="{{ url('/admin/products') }}"
                       class="px-5 py-3 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium transition">

                        Batal

                    </a>

                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-sm font-medium transition shadow-sm">

                        <i class="fas fa-save text-xs"></i>

                        Update Produk

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection