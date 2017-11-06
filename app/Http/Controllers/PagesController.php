<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Category;
use Mockery\Generator\CachingGenerator;

class PagesController extends Controller
{
    public function index($id = null)
    {
        $categories = Category::orderBy('id')->get();
        if (is_null($id) && $categories->count() > 0) {
            $id = $categories[0]->id;
        }
        $activeCategory = Category::findOrFail($id);

        return view('home', compact('categories', 'activeCategory'));
    }
}
