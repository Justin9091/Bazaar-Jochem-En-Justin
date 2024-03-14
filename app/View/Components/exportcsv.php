<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ExportCsv extends Component
{
    public $userid;

    /**
     * Create a new component instance.
     *
     * @param  int  $userid
     * @return void
     */
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
        return view('components.exportcsv');
    }
}
