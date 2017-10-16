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

        $activeCategory = null;
        if ($id !== null) {
            foreach ($categories as $category) {
                if ($category->id === (int)$id) {
                    $activeCategory = $category;
                    break;
                }
            }
        } elseif ($categories->count() > 0) {
            $activeCategory = $categories[0];
        }

        //dd($questions->count());

        return view('home', compact('categories', 'activeCategory'));
    }
}
