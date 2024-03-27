<?php

namespace App\View\Components\Reviews;

use Illuminate\View\Component;

class AddReview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userid;
    public $adid;
    public function __construct(
        int $userid,
        $adid
    )
    {
        $this->userid = $userid;
        $this->adid = $adid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.review.add-review');
    }
}
