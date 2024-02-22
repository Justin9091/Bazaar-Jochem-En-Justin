<?php

namespace App\Http\Controllers;

use App\Models\Advertisment\Advertisment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('welcome')->with("advertisments", Advertisment::query()->paginate(10));
    }
}
