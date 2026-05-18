@props(['items' => []])

@php
    $breadcrumbs = $items ?: generate_breadcrumb();
    $last = array_key_last($breadcrumbs);
@endphp

<div class="mb-4 flex justify-between items-center">

    <!-- Title -->
    <h3 class="text-lg font-semibold text-gray-900 dark:text-zinc-100">
        {{ ucfirst($last) }}
    </h3>

    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">

            <!-- Home -->
            <li>
                <a href="{{ url('/admin') }}"
                   class="text-sm text-gray-500 dark:text-zinc-400 hover:text-gray-700 dark:hover:text-zinc-200 font-medium">
                    Home
                </a>
            </li>

            <!-- Items -->
            @foreach ($breadcrumbs as $label => $url)

                <li>
                    <div class="flex items-center">

                        <i class="fas fa-chevron-right text-gray-300 dark:text-zinc-600 text-xs"></i>

                        @if ($label === $last)

                            <span class="ml-4 text-sm font-semibold text-gray-700 dark:text-zinc-300">
                                {{ $label }}
                            </span>

                        @else

                            <a href="{{ $url }}"
                               class="ml-4 text-sm text-gray-500 dark:text-zinc-400 hover:text-gray-700 dark:hover:text-zinc-200 font-medium">
                                {{ $label }}
                            </a>

                        @endif

                    </div>
                </li>

            @endforeach

        </ol>
    </nav>

</div>