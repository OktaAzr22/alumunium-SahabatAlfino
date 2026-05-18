<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SahabatAlfino' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #F8FAFC;
        }

        .glass-nav {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
        }

        .modal-transition {
            transition: opacity 0.2s, visibility 0.2s;
        }
    </style>
</head>
<body class="antialiased">

    <x-navbar />

    <main>
        @yield('content')
    </main>

    @guest
        @include('auth.login')
        @include('auth.register')
    @endguest

   

{{-- ========================================= --}}
{{-- TRACKING MODAL --}}
{{-- ========================================= --}}
<div
    id="trackingModal"
    class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4"
>

    {{-- CARD --}}
    <div
        class="relative bg-white w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden animate-fadeIn"
    >

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Tracking Pesanan
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Cek progress pesanan Anda
                </p>

            </div>

            {{-- CLOSE --}}
            <button
                type="button"
                onclick="closeTrackingModal()"
                class="w-10 h-10 rounded-full hover:bg-slate-100 transition flex items-center justify-center text-slate-500"
            >
                <i class="fas fa-times"></i>
            </button>

        </div>

        {{-- CONTENT --}}
        <div
            id="trackingContent"
            class="p-6"
        >

            {{-- LOADING --}}
            <div class="py-16 text-center">

                <i class="fas fa-spinner fa-spin text-4xl text-sky-500 mb-5"></i>

                <h3 class="text-lg font-semibold text-slate-700">
                    Memuat Pesanan...
                </h3>

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- TRACKING SCRIPT --}}
{{-- ========================================= --}}
<script>

const trackingInput =
    document.getElementById('trackingInput');


// =========================================
// OPEN MODAL
// =========================================
function openTrackingModal()
{
    const modal =
        document.getElementById('trackingModal');

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


// =========================================
// CLOSE MODAL
// =========================================
function closeTrackingModal()
{
    const modal =
        document.getElementById('trackingModal');

    modal.classList.remove('flex');

    modal.classList.add('hidden');
}


// =========================================
// CLOSE CLICK OUTSIDE
// =========================================
document
.getElementById('trackingModal')
.addEventListener(
    'click',
    function(e)
{
    if (e.target === this) {

        closeTrackingModal();
    }
});


// =========================================
// ENTER SEARCH
// =========================================
trackingInput.addEventListener(
    'keypress',
    async function(e)
{
    if (e.key !== 'Enter') return;

    const code = this.value.trim();

    if (!code) return;

    openTrackingModal();

    // =========================================
    // RESET LOADING
    // =========================================
    document
    .getElementById('trackingContent')
    .innerHTML = `

        <div class="py-16 text-center">

            <i class="fas fa-spinner fa-spin text-4xl text-sky-500 mb-5"></i>

            <h3 class="text-lg font-semibold text-slate-700">
                Memuat Pesanan...
            </h3>

        </div>

    `;

    try {

        // =========================================
        // FETCH
        // =========================================
        const response =
            await fetch(`/track-order/${code}`);

        const data =
            await response.json();


        // =========================================
        // NOT FOUND
        // =========================================
        if (!data.success) {

            document
            .getElementById('trackingContent')
            .innerHTML = `

                <div class="py-16 text-center">

                    <div class="w-24 h-24 rounded-full bg-red-100 mx-auto flex items-center justify-center mb-6">

                        <i class="fas fa-circle-xmark text-red-500 text-5xl"></i>

                    </div>

                    <h3 class="text-2xl font-bold text-slate-800 mb-2">
                        Pesanan Tidak Ditemukan
                    </h3>

                    <p class="text-slate-500">
                        Pastikan kode resi benar.
                    </p>

                </div>

            `;

            return;
        }


        // =========================================
        // DATA
        // =========================================
        const order = data.order;

        const statuses = data.statuses;


        // =========================================
        // TIMELINE
        // =========================================
        let timeline = '';

        statuses.forEach(status => {

            const active =
                status.id <= order.status_id;

            timeline += `

                <div class="flex gap-4">

                    {{-- LEFT --}}
                    <div class="flex flex-col items-center">

                        <div class="
                            w-5 h-5 rounded-full border-4 border-white shadow

                            ${active
                                ? 'bg-sky-500'
                                : 'bg-gray-300'}
                        ">
                        </div>

                        <div class="
                            w-1 h-14

                            ${active
                                ? 'bg-sky-300'
                                : 'bg-gray-200'}
                        ">
                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div class="pb-8">

                        <h4 class="
                            font-semibold text-base

                            ${active
                                ? 'text-slate-800'
                                : 'text-slate-400'}
                        ">
                            ${status.name}
                        </h4>

                        <p class="
                            text-sm mt-1

                            ${active
                                ? 'text-slate-500'
                                : 'text-gray-400'}
                        ">
                            ${active
                                ? 'Status telah dilewati'
                                : 'Menunggu proses'}
                        </p>

                    </div>

                </div>

            `;
        });


        // =========================================
        // RENDER
        // =========================================
        document
        .getElementById('trackingContent')
        .innerHTML = `

            <div class="space-y-8">

                {{-- TOP INFO --}}
                <div class="grid md:grid-cols-2 gap-5">

                    {{-- LEFT --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                        <small class="text-slate-500">
                            Kode Order
                        </small>

                        <h3 class="text-xl font-bold text-slate-800 mt-1">
                            ${order.code}
                        </h3>

                        <div class="mt-5">

                            <small class="text-slate-500">
                                Produk
                            </small>

                            <h4 class="font-semibold text-slate-700 mt-1">
                                ${order.product.name}
                            </h4>

                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div class="bg-sky-50 rounded-2xl p-5 border border-sky-100">

                        <small class="text-slate-500">
                            Status Saat Ini
                        </small>

                        <div class="mt-3">

                            <span class="inline-flex px-4 py-2 rounded-full bg-sky-500 text-white text-sm font-semibold shadow-sm">
                                ${order.status.name}
                            </span>

                        </div>

                        <div class="mt-5">

                            <small class="text-slate-500">
                                Estimasi Harga
                            </small>

                            <h3 class="text-2xl font-bold text-green-600 mt-1">
                                Rp ${Number(order.estimated_price).toLocaleString('id-ID')}
                            </h3>

                        </div>

                    </div>

                </div>


                {{-- TIMELINE --}}
                <div>

                    <div class="flex items-center gap-3 mb-6">

                        <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center">

                            <i class="fas fa-bars-progress text-sky-600 text-lg"></i>

                        </div>

                        <div>

                            <h3 class="text-xl font-bold text-slate-800">
                                Progress Pesanan
                            </h3>

                            <p class="text-sm text-slate-500">
                                Status pengerjaan pesanan Anda
                            </p>

                        </div>

                    </div>

                    <div>

                        ${timeline}

                    </div>

                </div>

            </div>

        `;

    } catch (error) {

        console.log(error);

        document
        .getElementById('trackingContent')
        .innerHTML = `

            <div class="py-16 text-center">

                <div class="w-24 h-24 rounded-full bg-red-100 mx-auto flex items-center justify-center mb-6">

                    <i class="fas fa-triangle-exclamation text-red-500 text-5xl"></i>

                </div>

                <h3 class="text-2xl font-bold text-slate-800 mb-2">
                    Terjadi Kesalahan
                </h3>

                <p class="text-slate-500">
                    Gagal mengambil data pesanan.
                </p>

            </div>

        `;
    }
});

</script>

    <script>

        function openModal(id) {

            document.getElementById(id).classList.remove('hidden');

            document.body.style.overflow = 'hidden';

        }

        function closeModal(id) {

            document.getElementById(id).classList.add('hidden');

            document.body.style.overflow = 'auto';

        }

        function switchModal(current, target) {

            closeModal(current);

            openModal(target);

        }


      

    </script>

    @if(session('openModal'))

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                openModal('{{ session('openModal') }}');

            });

        </script>

    @endif
    
    @stack('scripts')

</body>
</html>