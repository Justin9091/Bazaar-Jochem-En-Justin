<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Review;

class ReviewList extends Component
{
    public $reviews;
    public $userid;
    public $adid;

    /**
     * Create a new component instance.
     *
     * @param  $reviews
     * @param  $userid
     * @return void
     */
    public function __construct($reviews, $userid, $adid)
    {
        $this->reviews = $reviews;
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
        return view('components.review.review-list');
    }
}
