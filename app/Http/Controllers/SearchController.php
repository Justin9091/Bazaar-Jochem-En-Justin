<?php

namespace App\Http\Controllers;

use App\Models\Advertisment\Advertisment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $referer = $request->headers->get('referer');
        $refererPath = parse_url($referer, PHP_URL_PATH);

        $searchTerm = $request->input('search-term');

        $request->session()->put('page', $refererPath);
        $request->session()->put('search', $searchTerm);
        $request->session()->save();

        return Redirect::back();
    }

    public function clearSearch(Request $request)
    {
        $request->session()->forget('search');
        $request->session()->forget('page');
        $request->session()->save();

        return Redirect::back();
    }

}
