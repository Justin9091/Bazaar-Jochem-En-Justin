<?php

namespace App\View\Components\Utils;

use Illuminate\View\Component;

class LanguageSwitcher extends Component
{

    private $languages;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->languages = ["en" => "English", "nl" => "Dutch"];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.language-switcher')
            ->with('languages', $this->languages);
    }
}
