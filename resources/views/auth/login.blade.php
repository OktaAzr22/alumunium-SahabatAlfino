<div
    id="userLoginModal"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden modal-transition"
>

    <div class="bg-white rounded-2xl max-w-md w-full mx-4 p-6 shadow-2xl">

        <div class="flex justify-between items-center">

            <h3 class="text-2xl font-bold text-slate-800">
                Login User
            </h3>

            <button
                type="button"
                onclick="closeModal('userLoginModal')"
                class="text-slate-400 hover:text-slate-600"
            >
                <i class="fas fa-times"></i>
            </button>

        </div>

        @if ($errors->has('login') || ($errors->any() && session('openModal') == 'userLoginModal'))

            <div class="mt-4 mb-2 rounded-2xl border border-red-200 bg-red-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 text-red-500">
                        <i class="fas fa-circle-exclamation"></i>
                    </div>

                    <div class="flex-1">

                        <h4 class="font-semibold text-red-700">
                            Login gagal
                        </h4>

                        @if ($errors->has('login'))

                            <p class="text-sm text-red-600 mt-1">
                                {{ $errors->first('login') }}
                            </p>

                        @else

                            <ul class="mt-2 space-y-1 text-sm text-red-600">

                                @foreach ($errors->all() as $error)

                                    <li class="flex items-center gap-2">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>

                                        <span>{{ $error }}</span>

                                    </li>

                                @endforeach

                            </ul>

                        @endif

                    </div>

                </div>

            </div>

        @endif

        <form
            action="{{ url('/login') }}"
            method="POST"
            class="mt-5 space-y-4"
        >

            @csrf

            <div>

                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    class="w-full border border-slate-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-sky-400"
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
                    class="w-full border border-slate-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-sky-400"
                >

            </div>

            <button
                type="submit"
                class="w-full bg-sky-600 hover:bg-sky-700 text-white py-3 rounded-xl font-bold transition"
            >
                Login
            </button>

            <p class="text-center text-sm text-slate-500">

                Belum punya akun?

                <button
                    type="button"
                    onclick="switchModal('userLoginModal','userRegisterModal')"
                    class="text-sky-600 font-semibold hover:underline"
                >
                    Register
                </button>

            </p>

        </form>

    </div>

</div>