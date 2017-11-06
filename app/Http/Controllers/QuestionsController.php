<?php

namespace App\Http\Controllers;

use App\Question;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $this->validate($request, [
            'question' => 'required|string|min:5|max:191'
        ]);

        $question->update($request->all());

        Log::info(Auth::user()->login.' отредактировал вопрос ('.$question->id.') из темы "'.$question->category->title.'" ('.$question->category->id.')');

        return redirect()->route('home', $question->category->id);
    }

    public function publish(Request $request, $id)
    {
        $question = Question::where('id', $id)->first();

        $question->update([
            'is_published' => (int)$request->publish
        ]);

        Log::info(Auth::user()->login.($request->publish ? ' опубликовал' : ' снял с публикации').'  вопрос ('.$question->id.') из темы "'.$question->category->title.'" ('.$question->category->id.')');

        return redirect()->route('home', $question->category->id);
    }

    public function reply(Request $request, $id)
    {
        $question = Question::where('id', $id)->first();

        $this->validate($request, [
            'answer' => 'required|string|min:5'
        ]);

        $question->update([
            'answer' => $request->answer
        ]);

        Log::info(Auth::user()->login.' ответил на вопрос ('.$question->id.') из темы "'.$question->category->title.'" ('.$question->category->id.')');

        return redirect()->route('home', $question->category->id);
    }

    public function changeCategory(Request $request, $id)
    {
        $question = Question::where('id', $id)->first();

        $this->validate($request, [
            'category_id' => 'integer'
        ]);

        $question->update([
            'category_id' => $request->category_id
        ]);

        Log::info(Auth::user()->login.' переместил вопрос ('.$question->id.') в тему "'.$question->category->title.'" ('.$question->category->id.')');

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
        Log::info(Auth::user()->login.' удалил вопрос ('.$question->id.') из темы "'.$question->category->title.'" ('.$question->category->id.')');

        $question->delete();
        return redirect()->route('home', $question->category->id);
    }
}
