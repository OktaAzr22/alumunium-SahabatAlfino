<div class="relative overflow-hidden rounded-3xl shadow-xl mb-4">

    <img 
        src="{{ $image ?? 'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=1600&auto=format&fit=crop' }}"
        alt="Banner Furnitur"
        class="w-full h-[280px] object-cover"
    >

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>

    <!-- Text -->
    <div class="absolute inset-0 flex items-center px-8 md:px-14">

        <div class="max-w-2xl text-white">

            <span class="bg-emerald-500/90 text-white text-xs px-4 py-1 rounded-full font-semibold tracking-wide">
                {{ $label ?? 'Dashboard User' }}
            </span>

            <h1 class="mt-4 text-3xl md:text-5xl font-extrabold leading-tight">

                {{ $title ?? 'Selamat Datang,' }}

                <span class="text-emerald-400">
                    {{ Auth::user()->name ?? 'User' }}
                </span>

            </h1>

            <p class="mt-4 text-sm md:text-base text-gray-200 leading-relaxed">
                {{ $description ?? 'Kelola pesanan furnitur aluminium Anda dengan mudah.' }}
            </p>

            <div class="mt-6 flex flex-wrap gap-3">

                

               

            </div>

        </div>

    </div>

</div>