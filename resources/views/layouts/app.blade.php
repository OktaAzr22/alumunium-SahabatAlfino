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

</body>
</html>