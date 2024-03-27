<?php

namespace App\View\Components\Reviews;

use Illuminate\View\Component;

class Review extends Component
{
    public $title;
    public $description;
    public $score;
    public $reviewer;
    public $date;

    public function __construct(
        string $title = '',
        string $description = '',
        int $score = 0,
        string $reviewer = '',
        string $date = ''
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->score = $score;
        $this->reviewer = $reviewer;
        $this->date = $date;
    }


    public function render()
    {
        return view('components.review.review');
    }
}
