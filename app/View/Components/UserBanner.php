<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserBanner extends Component
{
    public $image;
    public $label;
    public $title;
    public $description;

    public function __construct(
        $image = null,
        $label = 'Dashboard User',
        $title = 'Selamat Datang,',
        $description = 'Kelola pesanan furnitur aluminium Anda dengan mudah.'
    ) {
        $this->image = $image;
        $this->label = $label;
        $this->title = $title;
        $this->description = $description;
    }

    public function render(): View|Closure|string
    {
        return view('components.user-banner');
    }
}