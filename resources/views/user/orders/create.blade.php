@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- BANNER --}}
    <x-user-banner
        label="Custom Furnitur"
        title="Buat Pesanan"
        description="Sesuaikan ukuran furnitur aluminium sesuai kebutuhan Anda."
    />

    {{-- ERROR --}}
    @if ($errors->any())

        <div class="mt-6 bg-red-50 border border-red-200 rounded-2xl p-5">

            <div class="flex items-center gap-3 text-red-600">

                <i class="fas fa-circle-exclamation text-xl"></i>

                <h3 class="font-bold text-lg">
                    Terjadi Kesalahan
                </h3>

            </div>

            <ul class="mt-4 space-y-2 text-sm text-red-500">

                @foreach ($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="grid lg:grid-cols-3 gap-8 mt-8">

        {{-- PRODUCT DETAIL --}}
        <div class="lg:col-span-1">

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden sticky top-24">

                {{-- IMAGE --}}
                <div class="relative">

                    <img
                        src="{{ $product->image 
                            ? asset('storage/'.$product->image) 
                            : 'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=1600&auto=format&fit=crop' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-72 object-cover"
                    >

                    <div class="absolute top-4 left-4">

                        <span class="px-3 py-1 rounded-full bg-emerald-500 text-white text-xs font-semibold shadow-lg">
                            Aluminium
                        </span>

                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="p-6">

                    <h2 class="text-3xl font-extrabold text-slate-800">
                        {{ $product->name }}
                    </h2>

                    <p class="text-slate-500 mt-4 leading-relaxed">
                        {{ $product->description }}
                    </p>

                    <div class="mt-6">

                        <p class="text-sm text-slate-400">
                            Harga Dasar
                        </p>

                        <h3 class="text-4xl font-extrabold text-emerald-600 mt-2">

                            Rp {{ number_format($product->base_price,0,',','.') }}

                        </h3>

                    </div>

                    {{-- SPESIFIKASI --}}
                    <div class="grid grid-cols-3 gap-3 mt-8">

                        <div class="bg-slate-50 rounded-2xl p-3 text-center">

                            <p class="text-xs text-slate-400">
                                Panjang
                            </p>

                            <h4 class="font-bold text-slate-700 mt-1">
                                {{ $product->standard_length ?? '-' }}
                            </h4>

                        </div>

                        <div class="bg-slate-50 rounded-2xl p-3 text-center">

                            <p class="text-xs text-slate-400">
                                Lebar
                            </p>

                            <h4 class="font-bold text-slate-700 mt-1">
                                {{ $product->standard_width ?? '-' }}
                            </h4>

                        </div>

                        <div class="bg-slate-50 rounded-2xl p-3 text-center">

                            <p class="text-xs text-slate-400">
                                Tinggi
                            </p>

                            <h4 class="font-bold text-slate-700 mt-1">
                                {{ $product->standard_height ?? '-' }}
                            </h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- FORM --}}
        <div class="lg:col-span-2">

            <form
                action="{{ url('/orders') }}"
                method="POST"
                enctype="multipart/form-data"
                class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden"
            >

                @csrf

                <input
                    type="hidden"
                    name="product_id"
                    value="{{ $product->id }}"
                >

                {{-- HEADER --}}
                <div class="p-6 border-b border-slate-200">

                    <h2 class="text-2xl font-bold text-slate-800">
                        Form Custom Order
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Isi detail ukuran dan kebutuhan  Anda
                    </p>

                </div>

                <div class="p-6 space-y-8">

                    {{-- UKURAN --}}
                    <div>

                        <h3 class="text-lg font-bold text-slate-700 mb-4">
                            Ukuran Furnitur
                        </h3>

                        <div class="grid md:grid-cols-3 gap-5">

                            {{-- PANJANG --}}
                            <div>

                                <label class="text-sm font-semibold text-slate-600">
                                    Panjang (meter)
                                </label>

                                <input
                                    type="number"
                                    name="length"
                                    value="{{ old('length') }}"
                                    min="0.1"
                                    step="0.01"
                                    placeholder="Contoh: 1.5"
                                    required
                                    class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"
                                >

                                <p class="text-xs text-slate-400 mt-2">
                                    Gunakan satuan meter. Contoh: 0.5 = 50 cm
                                </p>

                            </div>

                            {{-- LEBAR --}}
                            <div>

                               <label class="text-sm font-semibold text-slate-600">
                                    Lebar (meter)
                                </label>

                                <input
                                    type="number"
                                    name="width"
                                    value="{{ old('width') }}"
                                    min="0.1"
                                    step="0.01"
                                    placeholder="Contoh: 0.8"
                                    required
                                    class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"
                                >

                                <p class="text-xs text-slate-400 mt-2">
                                    Gunakan satuan meter
                                </p>

                            </div>

                            {{-- TINGGI --}}
                            <div>

                                <label class="text-sm font-semibold text-slate-600">
                                    Tinggi (meter)
                                </label>

                                <input
                                    type="number"
                                    name="height"
                                    value="{{ old('height') }}"
                                    min="0.1"
                                    step="0.01"
                                    placeholder="Contoh: 2"
                                    required
                                    class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"
                                >

                                <p class="text-xs text-slate-400 mt-2">
                                    Gunakan satuan meter
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- JUMLAH --}}
                    <div>

                        <label class="text-sm font-semibold text-slate-600">
                            Jumlah Produk
                        </label>

                        <input
                            type="number"
                            name="qty"
                            min="1"
                            value="{{ old('qty', 1) }}"
                            class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"
                        >

                    </div>

                    {{-- MATERIAL --}}
                    <div>

                        <label class="text-sm font-semibold text-slate-600">
                            Material Aluminium
                        </label>

                        <select
                            name="material_id"
                            required
                            class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"
                        >

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

                    </div>

                    {{-- ACCESSORIES --}}
                    <div>

                        <h3 class="text-lg font-bold text-slate-700 mb-4">
                            Accessories Tambahan
                        </h3>

                        <div class="grid md:grid-cols-2 gap-4">

                            @forelse($accessories as $accessory)

                                <label class="flex items-center gap-4 border border-slate-200 rounded-2xl p-4 hover:border-emerald-400 transition cursor-pointer">

                                    <input
                                        type="checkbox"
                                        name="accessories[]"
                                        value="{{ $accessory->id }}"
                                        class="w-5 h-5 text-emerald-500 rounded"
                                    >

                                    <div>

                                        <h4 class="font-semibold text-slate-700">
                                            {{ $accessory->name }}
                                        </h4>

                                        <p class="text-sm text-emerald-600 mt-1">

                                            Rp {{ number_format($accessory->price) }}

                                        </p>

                                    </div>

                                </label>

                            @empty

                                <div class="col-span-full text-slate-500">

                                    Tidak ada accessories

                                </div>

                            @endforelse

                        </div>

                    </div>

                    {{-- CONTOH DESIGN --}}
<div>

    <div class="flex items-center justify-between mb-4">

        <div>

            <h3 class="text-lg font-bold text-slate-700">
                Contoh Design yang Disarankan
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Upload gambar dengan tampilan jelas agar tim kami mudah memahami kebutuhan furnitur Anda.
            </p>

        </div>

    </div>

    <div class="grid md:grid-cols-3 gap-4">

        {{-- CONTOH 1 --}}
        <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white">

            <img
                src="{{ asset('images/design-example-1.jpg') }}"
                alt="Contoh Design 1"
                class="w-full h-44 object-cover"
            >

            <div class="p-4">

                <h4 class="font-semibold text-slate-700">
                    Tampak Depan
                </h4>

                <p class="text-sm text-slate-500 mt-1">
                    Pastikan ukuran dan bentuk furnitur terlihat jelas.
                </p>

            </div>

        </div>

        {{-- CONTOH 2 --}}
        <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white">

            <img
                src="{{ asset('images/design-example-2.jpg') }}"
                alt="Contoh Design 2"
                class="w-full h-44 object-cover"
            >

            <div class="p-4">

                <h4 class="font-semibold text-slate-700">
                    Sketsa Ukuran
                </h4>

                <p class="text-sm text-slate-500 mt-1">
                    Sertakan ukuran panjang, lebar, dan tinggi.
                </p>

            </div>

        </div>

        {{-- CONTOH 3 --}}
        <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white">

            <img
                src="{{ asset('images/design-example-3.jpg') }}"
                alt="Contoh Design 3"
                class="w-full h-44 object-cover"
            >

            <div class="p-4">

                <h4 class="font-semibold text-slate-700">
                    Referensi Interior
                </h4>

                <p class="text-sm text-slate-500 mt-1">
                    Bisa berupa foto referensi dari internet atau Pinterest.
                </p>

            </div>

        </div>

    </div>

</div>
                    {{-- FILE --}}
                    <div>

                        <label class="text-sm font-semibold text-slate-600">
                            Upload Design
                        </label>

                        <div class="grid md:grid-cols-2 gap-5 mt-3">

                            {{-- INPUT --}}
                            <div>

                                <label
                                    for="designInput"
                                    class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-slate-300 rounded-3xl cursor-pointer hover:border-emerald-400 hover:bg-emerald-50/30 transition"
                                >

                                    <div class="flex flex-col items-center justify-center text-center px-5">

                                        <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center mb-4">

                                            <i class="fas fa-image text-emerald-600 text-2xl"></i>

                                        </div>

                                        <h4 class="font-bold text-slate-700">
                                            Upload Design
                                        </h4>

                                        <p class="text-sm text-slate-500 mt-2">
                                            Klik untuk upload gambar design furnitur
                                        </p>

                                        <p class="text-xs text-slate-400 mt-3">
                                            JPG, JPEG, PNG (max 2MB)
                                        </p>

                                    </div>

                                    <input
                                        id="designInput"
                                        type="file"
                                        name="design_file"
                                        accept=".jpg,.jpeg,.png"
                                        class="hidden"
                                    >

                                </label>

                            </div>

                            {{-- PREVIEW --}}
                            <div>

                                <div
                                    class="w-full h-56 rounded-3xl border border-slate-200 bg-slate-50 overflow-hidden relative"
                                >

                                    {{-- EMPTY --}}
                                    <div
                                        id="emptyPreview"
                                        class="absolute inset-0 flex flex-col items-center justify-center text-slate-400"
                                    >

                                        <i class="fas fa-image text-5xl mb-3"></i>

                                        <p class="text-sm">
                                            Preview gambar akan tampil di sini
                                        </p>

                                    </div>

                                    {{-- IMAGE --}}
                                    <img
                                        id="imagePreview"
                                        class="hidden w-full h-full object-cover"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- NOTES --}}
                    <div>

                        <label class="text-sm font-semibold text-slate-600">
                            Catatan Tambahan
                        </label>

                        <textarea
                            name="notes"
                            rows="5"
                            class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"
                            placeholder="Tambahkan detail kebutuhan furnitur Anda..."
                        >{{ old('notes') }}</textarea>

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="p-6 border-t border-slate-200 bg-slate-50 flex items-center justify-end gap-4">

                    <a
                        href="{{ url('/products') }}"
                        class="px-6 py-3 rounded-2xl border border-slate-300 text-slate-600 hover:bg-slate-100 transition font-semibold"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="px-8 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold shadow-lg transition"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Buat Pesanan
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection

@push('scripts')

<script>

    const designInput = document.getElementById('designInput');

    const imagePreview = document.getElementById('imagePreview');

    const emptyPreview = document.getElementById('emptyPreview');

    designInput.addEventListener('change', function(e) {

        const file = e.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(event) {

            imagePreview.src = event.target.result;

            imagePreview.classList.remove('hidden');

            emptyPreview.classList.add('hidden');

        };

        reader.readAsDataURL(file);

    });

</script>

@endpush

