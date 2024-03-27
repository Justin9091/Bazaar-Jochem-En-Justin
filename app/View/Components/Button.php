<?php

namespace App\View\Components;

use App\enum\ButtonType;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ButtonType $type = ButtonType::BLUE,
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
        return view('components.button')
            ->with('type', $this->type->getClass())
            ->with('class', $this->type->getClass());
    }
}
