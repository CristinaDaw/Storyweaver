<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public $cssFile;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cssFile = 'css/register.css')
    {
        $this->cssFile = $cssFile;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
