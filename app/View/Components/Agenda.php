<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Agenda extends Component
{
    public $userid;
    public function __construct($userid)
    {
        $this->userid = $userid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.agenda');
    }
}