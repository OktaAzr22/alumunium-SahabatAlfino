<?php

if (! function_exists('generate_breadcrumb')) {

    function generate_breadcrumb()
    {
        $segments = request()->segments();

        $breadcrumbs = [];

        $path = '';

        foreach ($segments as $segment) {

            // tetap tambahkan ke path
            $path .= '/' . $segment;

            // admin tidak ditampilkan
            if ($segment === 'admin') {
                continue;
            }

            // ubah slug jadi title
            $label = str_replace('-', ' ', $segment);

            $label = ucwords($label);

            // jika angka
            if (is_numeric($segment)) {
                $label = 'Detail';
            }

            $breadcrumbs[$label] = url($path);
        }

        return $breadcrumbs;
    }
}


