<nav class="glass-nav sticky top-0 z-50 border-b border-slate-200 shadow-sm">

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

        <div class="flex justify-between items-center h-16 md:h-20">

            {{-- LOGO --}}
            <div class="flex items-center gap-3">

                <i class="fab fa-alipay text-3xl text-slate-600 rotate-90"></i>

                <a
                    href="{{ url('/') }}"
                    class="font-extrabold text-2xl tracking-tight text-slate-800"
                >
                    Sahabat<span class="text-sky-600">Alfino</span>
                </a>

                <span class="hidden md:inline-block text-xs bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full">
                    Aluminium Custom
                </span>

            </div>

            {{-- MENU --}}
            <div class="hidden md:flex items-center space-x-7 text-slate-600 font-medium">

                <a
                    href="{{ url('/') }}"
                    class="hover:text-sky-600 transition"
                >
                    Beranda
                </a>

                <a
                    href="#produk-user"
                    class="hover:text-sky-600 transition"
                >
                    Produk
                </a>

                {{-- BELUM LOGIN --}}
                @guest

                    <a
                        href="#tentang"
                        class="hover:text-sky-600 transition"
                    >
                        Tentang
                    </a>

                @endguest

                {{-- SUDAH LOGIN --}}
                @auth

                    <a
                        href="{{ url('/my-orders') }}"
                        class="hover:text-sky-600 transition"
                    >
                        Pesanan Saya
                    </a>

                @endauth

            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex items-center gap-3">

                {{-- SEARCH --}}
                <div class="hidden md:flex items-center bg-white border border-slate-200 rounded-full px-4 py-2 shadow-sm">

                    <i class="fas fa-search text-slate-400 text-sm mr-2"></i>

                    <input
                        type="text"
                        placeholder="Punya Resi...?"
                        class="outline-none text-sm bg-transparent w-40"
                    >

                </div>

                {{-- BELUM LOGIN --}}
                @guest

                    <button
                        type="button"
                        onclick="openModal('userLoginModal')"
                        class="px-4 py-2 rounded-full text-sm font-semibold border border-sky-200 bg-white text-sky-700 hover:bg-sky-50 transition flex items-center gap-2 shadow-sm"
                    >
                        <i class="fas fa-user-circle"></i>
                        Login
                    </button>

                @endguest

                {{-- SUDAH LOGIN --}}
                @auth

                    {{-- RIWAYAT --}}
                    <a
                        href="{{ url('/my-orders') }}"
                        class="px-4 py-2 rounded-full text-sm font-semibold border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 transition flex items-center gap-2"
                    >
                        <i class="fas fa-clock-rotate-left"></i>
                        Riwayat
                    </a>

                    {{-- LOGOUT --}}
                    <form
                        action="{{ url('/logout') }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-full text-sm font-semibold bg-red-500 text-white hover:bg-red-600 transition"
                        >
                            Logout
                        </button>

                    </form>

                @endauth

            </div>

        </div>

    </div>

</nav>