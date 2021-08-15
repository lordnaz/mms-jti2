<?php

namespace App\View\Components\pages\jti;

use Illuminate\View\Component;

class jti-actual extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.pages.jti.jti-actual');
    }
}
