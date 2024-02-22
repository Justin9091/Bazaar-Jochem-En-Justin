<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AddReview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userid;
    public $reviewer;
    public function __construct(
        int $userid,
        string $reviewer = ''
    )
    {
        $this->userid = $userid;
        $this->reviewer = $reviewer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.add-review');
    }
}
