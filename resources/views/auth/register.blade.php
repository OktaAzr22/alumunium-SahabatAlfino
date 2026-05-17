<div
    id="userRegisterModal"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden modal-transition"
>

    <div class="bg-white rounded-2xl max-w-md w-full mx-4 p-6 shadow-2xl max-h-[90vh] overflow-y-auto scrollbar-thin">

        <div class="flex justify-between items-center">

            <div>
                <h3 class="text-2xl font-bold text-slate-800">
                    Register User
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Buat akun baru untuk mulai custom furniture
                </p>
            </div>

            <button
                type="button"
                onclick="closeModal('userRegisterModal')"
                class="w-9 h-9 rounded-full hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition flex items-center justify-center"
            >
                <i class="fas fa-times"></i>
            </button>

        </div>

        @if ($errors->any() && session('openModal') == 'userRegisterModal')

            <div class="mt-5 rounded-2xl border border-red-200 bg-red-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-circle-exclamation"></i>
                    </div>

                    <div class="flex-1">

                        <h4 class="text-sm font-semibold text-red-700">
                            Registrasi gagal
                        </h4>

                        <p class="text-sm text-red-500 mt-1">
                            Periksa kembali data yang Anda isi.
                        </p>

                        <ul class="mt-3 space-y-2">

                            @foreach ($errors->all() as $error)

                                <li class="flex items-start gap-2 text-sm text-red-700">

                                    <span class="mt-1 text-[8px]">
                                        <i class="fas fa-circle"></i>
                                    </span>

                                    <span>{{ $error }}</span>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif

        <form
            action="{{ url('/register') }}"
            method="POST"
            class="mt-5 space-y-4"
        >

            @csrf

            <div>

                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    class="w-full border border-slate-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition"
                >

            </div>

            <div>

                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    class="w-full border border-slate-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition"
                >

            </div>

            <div>

                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full border border-slate-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition"
                >

            </div>

            <div>

                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    class="w-full border border-slate-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition"
                >

            </div>

            <button
                type="submit"
                class="w-full bg-sky-600 hover:bg-sky-700 text-white py-3 rounded-xl font-bold transition shadow-md"
            >
                Daftar Sekarang
            </button>

            <p class="text-center text-sm text-slate-500">

                Sudah punya akun?

                <button
                    type="button"
                    onclick="switchModal('userRegisterModal','userLoginModal')"
                    class="text-sky-600 font-semibold hover:underline"
                >
                    Login
                </button>

            </p>

        </form>

    </div>

</div>