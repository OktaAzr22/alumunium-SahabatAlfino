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

                <a
                    href="#form-custom"
                    class="hover:text-sky-600 transition"
                >
                    Custom Order
                </a>

                <a
                    href="#tentang"
                    class="hover:text-sky-600 transition"
                >
                    Tentang
                </a>

            </div>

            {{-- AUTH --}}
            <div class="flex items-center gap-3">

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

                    <button
                        type="button"
                        onclick="openModal('userRegisterModal')"
                        class="px-4 py-2 rounded-full text-sm font-semibold bg-sky-600 text-white hover:bg-sky-700 transition shadow-md flex items-center gap-2"
                    >
                        <i class="fas fa-user-plus"></i>
                        Register
                    </button>

                @endguest

                {{-- SUDAH LOGIN --}}
                @auth

                    <div class="flex items-center gap-3">

                        <div class="hidden md:flex flex-col text-right">

                            <span class="text-xs text-slate-400">
                                Selamat datang
                            </span>

                            <span class="font-semibold text-slate-700">
                                {{ auth()->user()->name }}
                            </span>

                        </div>

                        {{-- DASHBOARD --}}
                        @if(auth()->user()->role === 'admin')

                            <a
                                href="{{ url('/admin') }}"
                                class="px-4 py-2 rounded-full text-sm font-semibold bg-slate-800 text-white hover:bg-slate-900 transition"
                            >
                                Dashboard
                            </a>

                        @elseif(auth()->user()->role === 'super_admin')

                            <a
                                href="{{ url('/super-admin') }}"
                                class="px-4 py-2 rounded-full text-sm font-semibold bg-purple-600 text-white hover:bg-purple-700 transition"
                            >
                                Super Admin
                            </a>

                        @else

                            <a
                                href="{{ url('/dashboard') }}"
                                class="px-4 py-2 rounded-full text-sm font-semibold bg-sky-600 text-white hover:bg-sky-700 transition"
                            >
                                Dashboard
                            </a>

                        @endif

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

                    </div>

                @endauth

            </div>

        </div>

    </div>

</nav>