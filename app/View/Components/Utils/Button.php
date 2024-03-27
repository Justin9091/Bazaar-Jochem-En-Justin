<?php

namespace App\View\Components\Utils;

use App\enum\ButtonType;
use Illuminate\View\Component;

class Button extends Component
{

    private ButtonType $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = ButtonType::RED)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.button')
            ->with('type', $this->type->getClass())
            ->with('class', $this->type->getClass());
    }
}
