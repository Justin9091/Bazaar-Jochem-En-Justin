<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageComponent extends Component
{
    private $imagePath;
    private $description;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($component)
    {
        $json = json_decode($component->property);

        $this->imagePath = $json->imagePath;
        $this->description = $json->description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.landing.image-component')
            ->with('imagePath', $this->imagePath)
            ->with('description', $this->description);
    }
}
