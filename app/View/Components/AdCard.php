<?php

namespace App\View\Components;

use App\Models\advertisement\Advertisement;
use Illuminate\View\Component;

class AdCard extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $ad
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.advertisements.ad-card')->with('ad', $this->ad);
    }
}
