<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageSwitchRequest;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(LanguageSwitchRequest $request) {
        $validated = $request->validated();
        $locale = $validated['locale'];

        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
