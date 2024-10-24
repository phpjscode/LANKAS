<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public string $title;  // Pastikan ini adalah string

    public function __construct(string $title = 'Default Title') // Ada nilai default
    {
        $this->title = $title;  // Simpan nilai
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout');
    }
}
