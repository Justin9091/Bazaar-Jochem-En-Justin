<?php

namespace App\Http\Controllers;

use App\Models\advertisement\Advertisement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('welcome')->with("advertisements", Advertisement::orderBy('id', 'desc')->paginate(10));
    }
}
