<?php

if (! function_exists('generate_breadcrumb')) {

    function generate_breadcrumb()
    {
        $segments = request()->segments();

        $breadcrumbs = [];

        $path = '';

        foreach ($segments as $segment) {

            if ($segment === 'admin') {
                continue;
            }

            $path .= '/' . $segment;

            // ubah slug jadi title
            $label = str_replace('-', ' ', $segment);

            $label = ucwords($label);

            // kalau ID angka
            if (is_numeric($segment)) {
                $label = 'Detail';
            }

            $breadcrumbs[$label] = url($path);
        }

        return $breadcrumbs;
    }
}