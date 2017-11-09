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
        $id = is_null($id) && $categories->count() ? $categories[0]->id : $id;
        !is_null($id) && $activeCategory = Category::findOrFail($id);

        return view('home', compact('categories', 'activeCategory'));
    }
}
