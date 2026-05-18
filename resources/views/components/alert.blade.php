@props([
    'type' => 'success',
    'message' => null,
])

@php

    $styles = [

        'success' => [
            'wrapper' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
            'icon' => 'fa-circle-check',
        ],

        'error' => [
            'wrapper' => 'bg-red-50 border-red-200 text-red-700',
            'icon' => 'fa-circle-xmark',
        ],

        'warning' => [
            'wrapper' => 'bg-amber-50 border-amber-200 text-amber-700',
            'icon' => 'fa-triangle-exclamation',
        ],

        'info' => [
            'wrapper' => 'bg-sky-50 border-sky-200 text-sky-700',
            'icon' => 'fa-circle-info',
        ],

    ];

    $style = $styles[$type];

@endphp

@if($message)

    <div
        class="
            mb-6
            border
            px-4
            py-3
            rounded-2xl
            text-sm
            flex
            items-center
            gap-3
            shadow-sm
            {{ $style['wrapper'] }}
        "
    >

        <i class="fas {{ $style['icon'] }}"></i>

        <div>

            {{ $message }}

        </div>

    </div>

@endif