<?php

namespace App\Http\Controllers;

use App\Question;
use App\Author;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::where('answer', NULL)->orderBy('created_at', 'desc')->get();
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:1|max:191',
            'email' => 'required|string|email',
            'category_id' => 'required|integer',
            'question' => 'required|string|min:5|max:191'
        ]);

        $author = Author::firstOrCreate([
            'email' => $request['email']
        ], [
            'name' => $request['name'],
            'email' => $request['email']
        ]);

        $question = new Question([
            'question' => $request['question'],
            'is_published' => false,
            'category_id' => $request['category_id'],
            'author_id' => $author->id
        ]);

        $author->questions()->save($question);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.form', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validateParams = [];
        $updateParams = [];

        if (isset($request->update_question)) {
            $validateParams['question'] = 'required|string|min:5|max:191';
            $updateParams['question'] = $request->question;
            $updateParams['answer'] = $request->answer;
        } elseif (isset($request->publish)) {
            $updateParams['is_published'] = ($request->publish === 'publish');
        } elseif (isset($request->category_id)) {
            $validateParams['category_id'] = 'integer';
            $updateParams['category_id'] = $request->category_id;
        } elseif (isset($request->answer)) {
            $validateParams['answer'] = 'required|string|min:5';
            $updateParams['answer'] = $request->answer;
        }

        $this->validate($request, $validateParams);
        $question->update($updateParams);

        return redirect()->route('home', $question->category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('home', $question->category->id);
    }
}
