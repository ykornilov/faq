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

        if ($categories->count() > 0) {
            foreach ($categories as $category) {
                $questionsWithoutAnswer = 0;
                $questionsUnpublished = 0;
                if ($category->questions->count() > 0) {
                    foreach ($category->questions as $question) {
                        if (empty($question->answer)) {
                            ++$questionsWithoutAnswer;
                        }
                        if (!$question->is_published) {
                            ++$questionsUnpublished;
                        }
                    }
                }
                $category->questionsWithoutAnswers = $questionsWithoutAnswer;
                $category->questionsUnpublished = $questionsUnpublished;
            }
        }

        return view('home', compact('categories', 'activeCategory'));
    }
}
