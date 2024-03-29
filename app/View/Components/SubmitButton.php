<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $value = "Submit",
        private $dusk = "submit-button",
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.submit-button')->with([
            'dusk' => $this->dusk ?? 'submit-button',
            'value' => $this->value,
        ]);
    }
}
