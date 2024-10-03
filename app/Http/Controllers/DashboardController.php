<?php

namespace App\Http\Controllers;

use App\Models\Blog\Library;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        // $tags = Tag::getWithType('library');
        // dd(config('zeus-sky.models.Tag')::getWithType('library'));
        return view('dashboard')
            ->with('libraryTags', config('zeus-sky.models.Tag')::getWithType('library'))
            ->with('libraries', config('zeus-sky.models.Library')::get());
    }

    public function get_library_by_category_slug(Request $request)
    {
    }

    public function getTagItemsBySlug(Request $request)
    {
        // get Tag by slug
        $tag = Tag::findBySlug($request->slug, 'library');

        $libraries = Library::withAnyTags($tag->name, 'library')->get();

        $libraries->each(function ($lib) {
            $lib->files = $lib->getFiles();
            return $lib;
        });

        return response()->json($libraries);
    }
}
