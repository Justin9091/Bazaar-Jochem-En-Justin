<?php

namespace App\View\Components\Components;

use Illuminate\View\Component;

class TextComponent extends Component
{
    private $text;
    private $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($component)
    {
        $json = json_decode($component->property);

        $this->id = $component->id;
        $this->text = $json->text;
        $this->size = $json->size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.landing.text-component')
            ->with('text', $this->text)
            ->with('size', $this->size)
            ->with('id', $this->id);
    }
}
