<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RadioSelect extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $options,
        public $selected = null,
        public $name = "value",
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.radio-select');
    }
}
