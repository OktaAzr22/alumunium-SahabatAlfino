@extends('layouts.app')

@section('content')

  <section class="alum-bg relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-24">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div>
          <div class="inline-flex gap-2 bg-sky-100 text-sky-800 rounded-full px-4 py-1.5 text-sm font-medium mb-5"><i class="fas fa-industry"></i> Anti karat & tahan lama</div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-slate-800">Furnitur <span class="text-sky-600">Aluminium</span> Custom Modern</h1>
            <p class="text-slate-500 text-lg mt-6 max-w-lg">Ringan, minimalis, bebas karat. Desain rakitan presisi untuk rumah, kantor, dan outdoor. 100% customizable.</p>
            <div class="flex flex-wrap gap-4 mt-8">

                    @guest

                        <button
                            onclick="openModal('userRegisterModal')"
                            class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition flex items-center gap-2"
                        >
                            <i class="fas fa-user-plus"></i>

                            Daftar User
                        </button>

                    @endguest

                    @auth

                        <a
                            href="{{ url('/dashboard') }}"
                            class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition flex items-center gap-2"
                        >
                            <i class="fas fa-box-open"></i>

                            Kembali Dashboard
                        </a>

                    @endauth

                </div>

            </div>
          <div class="relative">
            <img src="https://images.pexels.com/photos/9310077/pexels-photo-9310077.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Aluminium furniture" class="rounded-2xl shadow-2xl object-cover w-full h-80 md:h-96 border-8 border-white">
            <div class="absolute -bottom-4 -left-4 bg-white/90 backdrop-blur p-3 rounded-xl shadow-lg hidden md:flex items-center gap-2"><i class="fas fa-check-double text-sky-600"></i><span class="font-semibold">Garansi 5 tahun</span></div>
          </div>
        </div>
      </div>
  </section>

  <section
    id="produk-user"
    class="py-16 md:py-24 px-5 max-w-7xl mx-auto">

    <div class="text-center mb-12">

        <p class="text-sky-600 font-bold tracking-wide uppercase text-sm">
            Koleksi Premium
        </p>

        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 mt-2">
            Produk Aluminium Pilihan
        </h2>

        <p class="text-slate-500 max-w-2xl mx-auto mt-3">
            Desain modern, custom ukuran, finishing premium & tahan lama.
        </p>

    </div>

    {{-- GRID PRODUK --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-7">

        @forelse($products as $product)

            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 hover:-translate-y-1 hover:shadow-xl transition duration-300">

                <div class="h-56 bg-slate-100 overflow-hidden">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                        >

                    @else

                        <div class="w-full h-full flex items-center justify-center text-slate-400">

                            <i class="fas fa-image text-5xl"></i>

                        </div>

                    @endif

                </div>


                <div class="p-5">

                    <h3 class="font-bold text-lg text-slate-800 line-clamp-1">
                        {{ $product->name }}
                    </h3>

                    <p class="text-sm text-slate-500 mt-2 line-clamp-2">
                        {{ $product->description ?? 'Tidak ada deskripsi produk.' }}
                    </p>

                    {{-- HARGA --}}
                    <div class="mt-4 flex items-center justify-between">

                        <div>

                            <p class="text-xs text-slate-400">
                                Mulai dari
                            </p>

                            <h4 class="text-sky-700 font-bold text-lg">
                                Rp {{ number_format($product->base_price,0,',','.') }}
                            </h4>

                        </div>

                        
                        <button
                            type="button"
                            onclick="openModal('userLoginModal')"
                            class="px-4 py-2 rounded-xl bg-sky-600 text-white text-sm font-semibold hover:bg-sky-700 transition"
                        >
                            Pesan
                        </button>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full text-center py-20">

                <div class="text-slate-300 text-6xl mb-4">
                    <i class="fas fa-box-open"></i>
                </div>

                <h3 class="text-xl font-bold text-slate-700">
                    Produk belum tersedia
                </h3>

            </div>

        @endforelse

        

    </div>
    <div class="text-center mt-12">
        <a href="{{ url('/product') }}">
        <button class="border border-sky-300 text-sky-700 bg-white px-7 py-2.5 rounded-full font-medium hover:bg-sky-50 transition">Lihat Semua Koleksi 
            <i class="fas fa-chevron-right ml-1 text-xs">
                </i>
        </button>
        </a>
    </div>

  </section>

    <section id="tentang" class="max-w-7xl mx-auto px-5 py-16 md:py-20 bg-slate-50 rounded-3xl my-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div><img src="https://images.pexels.com/photos/7990459/pexels-photo-7990459.jpeg?auto=compress&cs=tinysrgb&w=500" class="rounded-2xl shadow-lg" alt="Aluminium craft"></div>
            <div><h2 class="text-3xl font-bold text-slate-800">Kenapa <span class="text-sky-600">Aluminium?</span> Modern & Kokoh</h2><p class="text-slate-500 mt-4 leading-relaxed">AluCraft menggunakan aluminium berkualitas aerospace-grade, finishing powder coating anti gores. Cocok untuk area lembab maupun outdoor. Proses custom cepat dan ramah lingkungan karena alumunium 100% dapat didaur ulang.</p><div class="grid grid-cols-2 gap-4 mt-8"><div><i class="fas fa-tachometer-alt text-sky-600 text-xl"></i><p class="font-semibold">Ringan & Kuat</p></div><div><i class="fas fa-water text-sky-600 text-xl"></i><p class="font-semibold">Anti karat</p></div><div><i class="fas fa-palette text-sky-600 text-xl"></i><p class="font-semibold">20+ pilihan warna</p></div><div><i class="fas fa-tools text-sky-600 text-xl"></i><p class="font-semibold">Garansi 5 tahun</p></div></div></div>
        </div>
    </section>

@endsection