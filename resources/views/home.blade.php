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
              <button onclick="openModal('userRegisterModal')" class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition flex items-center gap-2"><i class="fas fa-crown"></i> Daftar User</button>
                        
            </div>
          </div>
          <div class="relative">
            <img src="https://images.pexels.com/photos/9310077/pexels-photo-9310077.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Aluminium furniture" class="rounded-2xl shadow-2xl object-cover w-full h-80 md:h-96 border-8 border-white">
            <div class="absolute -bottom-4 -left-4 bg-white/90 backdrop-blur p-3 rounded-xl shadow-lg hidden md:flex items-center gap-2"><i class="fas fa-check-double text-sky-600"></i><span class="font-semibold">Garansi 5 tahun</span></div>
          </div>
        </div>
      </div>
  </section>

@endsection