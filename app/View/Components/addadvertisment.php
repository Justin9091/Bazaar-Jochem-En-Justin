<?php

namespace App\View\Components;

use Illuminate\View\Component;

class addadvertisment extends Component
{
    public $userid;
    public function __construct($userid)
    {
        $this->userid = $userid;
    }

    public function render()
    {
        return view('components.addadvertisment');
    }
}
