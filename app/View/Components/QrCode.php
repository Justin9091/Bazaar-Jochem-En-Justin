<?php

namespace App\View\Components;

use Illuminate\View\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QR;

class QrCode extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $url
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
        return view('components.qr-code')
        ->with('qr', QR::size(100)->generate($this->url));
    }
}
