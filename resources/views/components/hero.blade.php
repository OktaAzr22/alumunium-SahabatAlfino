@props([
    'title' => 'Title',
    'description' => null,

    'buttonText' => null,
    'buttonLink' => null,
])

<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 p-8 mb-8 shadow-lg">

    {{-- DECORATION --}}
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>

    <div class="absolute bottom-0 right-20 w-24 h-24 bg-white/10 rounded-full"></div>

    <div class="absolute top-10 left-1/2 w-16 h-16 bg-white/10 rounded-full"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

        {{-- LEFT --}}
        <div>

            <h1 class="text-4xl font-black text-white leading-tight">
                {{ $title }}
            </h1>

            @if($description)

                <p class="text-sky-100 mt-3 text-sm md:text-base max-w-xl">
                    {{ $description }}
                </p>

            @endif

        </div>

        {{-- BUTTON --}}
        @if($buttonText && $buttonLink)

            <div>

                <a href="{{ url($buttonLink) }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-white text-blue-600 hover:bg-sky-50 rounded-2xl text-sm font-bold transition shadow-lg">

                    

                    {{ $buttonText }}

                </a>

            </div>

        @endif

    </div>

</div>