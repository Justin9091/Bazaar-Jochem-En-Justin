<?php

namespace App\View\Components;

use App\Models\UserFavorite;
use Illuminate\View\Component;

class FavoriteStar extends Component
{
    public $isFavorited = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $ad,
    )
    {
        if (auth()->check()) {
            /*$this->isFavorited = UserFavorite::all()
                ->where('user_id', auth()->id())
                ->where('advertisement_id', $this->ad->id)
                ->count() > 0;*/

            $this->isFavorited = auth()->user()->favorites()->where('advertisement_id', $this->ad->id)->exists();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.favorite-star')
            ->with('ad', $this->ad)
            ->with('isFavorited', $this->isFavorited);
    }
}
