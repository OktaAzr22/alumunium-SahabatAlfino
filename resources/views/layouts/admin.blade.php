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
        body {
            font-family: 'Inter', sans-serif;
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .rotate-transition {
            transition: transform 0.2s ease;
        }
        .sidebar-scrollable {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
        }
        .sidebar-scrollable::-webkit-scrollbar {
            width: 4px;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">
  <div class="flex h-screen overflow-hidden">
    @include('partials.sidebar')
    <main class="flex-1 overflow-y-auto bg-gray-50">
      @yield('content')
    </main>
  </div>

    
    <script>

    document.querySelectorAll('.submenu-toggle').forEach(button => {

        button.addEventListener('click', () => {

            const submenuContent =
                button.nextElementSibling;

            const arrowIcon =
                button.querySelector('.fa-chevron-down');

            const mainIcon =
                button.querySelector('.menu-icon');

            if (submenuContent.classList.contains('hidden')) {

                submenuContent.classList.remove('hidden');

                button.classList.add('bg-indigo-50');

                if (mainIcon) {

                    mainIcon.classList.remove('text-gray-500');
                    mainIcon.classList.add('text-gray-900');

                }

                if (arrowIcon) {

                    arrowIcon.classList.add('rotate-180');
                    arrowIcon.classList.remove('text-gray-400');
                    arrowIcon.classList.add('text-gray-900');

                }

            }

            else {

                submenuContent.classList.add('hidden');

                button.classList.remove('bg-indigo-50');

                if (mainIcon) {

                    mainIcon.classList.remove('text-gray-900');
                    mainIcon.classList.add('text-gray-500');

                }

                if (arrowIcon) {

                    arrowIcon.classList.remove('rotate-180');
                    arrowIcon.classList.remove('text-gray-900');
                    arrowIcon.classList.add('text-gray-400');

                }

            }

        });

    });

</script>
    @stack('scripts')

</body>
</html>