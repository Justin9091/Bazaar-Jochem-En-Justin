<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class DropdownSelect extends Component
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
        return view('components.form.dropdown-select')->with([
            'options' => $this->options,
            'selected' => $this->selected,
            'name' => $this->name,
        ]);
    }
}
