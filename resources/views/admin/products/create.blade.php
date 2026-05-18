@extends('layouts.admin')

@section('content')


<div class="min-h-screen bg-gray-50 py-8 px-4 md:px-6">

    <div class="max-w-7xl mx-auto">
        <x-breadcrumb />

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4">
            <div class="flex items-start gap-3">

                <div class="mt-1">
                    <i class="fas fa-exclamation-circle"></i>
                </div>

                <div>
                    <h3 class="font-semibold mb-2">
                        Terjadi kesalahan
                    </h3>

                    <ul class="text-sm list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
        @endif

        <!-- FORM -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <form action="{{ url('/admin/products') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="p-6 space-y-6">

                    <!-- NAMA -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Produk
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               placeholder="Masukkan nama produk"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">
                    </div>

                    <!-- DESKRIPSI -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>

                        <textarea name="description"
                                  rows="4"
                                  placeholder="Masukkan deskripsi produk"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none resize-none">{{ old('description') }}</textarea>
                    </div>

                    <!-- HARGA -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga Dasar
                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                Rp
                            </span>

                            <input type="number"
                                   name="base_price"
                                   value="{{ old('base_price') }}"
                                   required
                                   min="0"
                                   placeholder="0"
                                   class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                        </div>
                    </div>

                    <!-- UKURAN -->
                    <div>

                        <h3 class="text-sm font-semibold text-gray-700 mb-4">
                            Ukuran Standar Produk
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <!-- PANJANG -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">
                                    Panjang
                                </label>

                                <div class="relative">

                                    <input type="number"
                                           step="0.01"
    min="0.1"
                                           name="standard_length"
                                           value="{{ old('standard_length') }}"
                                           placeholder="0"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                                        cm
                                    </span>

                                </div>
                            </div>

                            <!-- LEBAR -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">
                                    Lebar
                                </label>

                                <div class="relative">

                                    <input type="number"
                                            step="0.01"
    min="0.1"
                                           name="standard_width"
                                           value="{{ old('standard_width') }}"
                                           placeholder="0"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                                        cm
                                    </span>

                                </div>
                            </div>

                            <!-- TINGGI -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-2">
                                    Tinggi
                                </label>

                                <div class="relative">

                                    <input type="number"
                                          step="0.01"
    min="0.1"
                                           name="standard_height"
                                           value="{{ old('standard_height') }}"
                                           placeholder="0"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                                        cm
                                    </span>

                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- FRAME -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Frame Multiplier
                        </label>

                        <input type="number"
                               step="0.1"
                               name="frame_multiplier"
                               value="{{ old('frame_multiplier', 2) }}"
                               class="w-full md:w-60 px-4 py-3 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none">

                        <p class="text-xs text-gray-500 mt-2">
                            Semakin besar angka, semakin banyak kebutuhan material
                        </p>

                    </div>

                    <!-- IMAGE -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Gambar Produk
                        </label>

                        <input type="file"
                               id="imageInput"
                               name="image"
                               accept="image/*"
                               onchange="previewImage(event)"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white">

                        <!-- PREVIEW -->
                        <div id="previewContainer"
                             class="hidden mt-4">

                            <img id="imagePreview"
                                 class="w-44 h-44 object-cover rounded-2xl border border-gray-200">

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">

                    <a href="{{ url('/admin/products') }}"
                       class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 text-sm font-medium">
                        Batal
                    </a>

                    <button type="reset"
                            class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 text-sm font-medium">
                        Reset
                    </button>

                    <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium">
                        Simpan Produk
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    function previewImage(event) {

        const input = event.target;
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('previewContainer');

        if (input.files && input.files[0]) {

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);

        }

    }
</script>

@endsection