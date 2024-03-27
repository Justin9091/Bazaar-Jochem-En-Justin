<?php

namespace App\View\Components\Advertisements;

use Illuminate\View\Component;

class AddAdvertisement extends Component
{
    public $userid;
    public function __construct($userid)
    {
        $this->userid = $userid;
    }

    public function render()
    {
        return view('components.advertisements.addadvertisement');
    }
}
