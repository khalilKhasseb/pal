<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() : View {
        return view('dashboard')->with('categories', config('zeus-sky.models.Tag')::getWithType('library'))
        ->with('libraries' , config('zeus-sky.models.Library')::get());
    }

    public function get_library_by_category_slug(Request $request) {

    }
}
