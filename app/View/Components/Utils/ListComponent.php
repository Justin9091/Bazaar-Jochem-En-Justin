<?php

namespace App\View\Components\Utils;

use App\Models\advertisement\Advertisement;
use Illuminate\View\Component;

class ListComponent extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $advertisements,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // Get the search term from the session
        $searchTerm = session('search');
        $searchedPage = session('page');

        $request = request();
        $currentUrl = $request->fullUrl();
        $path = parse_url($currentUrl, PHP_URL_PATH);

        // If the current page is not the same as the page that was searched on clear the search term
        if ($searchedPage && $searchedPage != '/' && $searchedPage !== $path) {
            session()->forget('search');
            session()->forget('page');
            session()->save();
        }

        if ($searchTerm) {
            $this->advertisements = Advertisement::query()
                ->where('title', 'like', '%' . $searchTerm . '%')
                ->orderBy('id', 'desc')
                ->cursorPaginate(10);

        } else {
            $this->advertisements = Advertisement::query()->orderBy('id', 'desc')->paginate(10);
        }

        return view('components.utils.list-component');
    }


}
