@extends('layouts.app')

@section('content')
<div class="container content">

    @if($categories->count() > 0)
        <div class="row">

            <div class="col-md-4">

                <div class="list-group">
                    @foreach($categories as $category)
                        <a href="{{ route('home', $category->id) }}" class="list-group-item @if($activeCategory && $activeCategory->id === $category->id){{  'active' }}@endif">
                            {{ $category->title }}
                            @auth
                                <span class="badge badge-danger" data-toggle="tooltip" title="Questons without answer">{{ $category->questions()->whereNull('answer')->get()->count() }}</span>
                                <span class="badge badge-warning" data-toggle="tooltip" title="Unpublished questions">{{ $category->questions()->where('is_published', false)->get()->count() }}</span>
                                <span class="badge" data-toggle="tooltip" title="Questions">{{ $category->questions->count() }}</span>
                            @endauth
                        </a>
                    @endforeach
                </div>

            </div>

            <div class="col-md-7 col-md-offset-1">

                @if($activeCategory->questions->count() > 0)
                    <div id="section" class="panel-group">
                        @foreach($activeCategory->questions as $question)
                            @if (Auth::check() || (Auth::guest() && $question->is_published && isset($question->answer)))
                                <div class="panel @if($question->is_published && isset($question->answer)){{ 'panel-info' }}@elseif(!empty($question->answer)){{ 'panel-warning' }}@else{{ 'panel-danger' }}@endif">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" data-parent="#section" href="#el{{ $question->id }}" style="text-decoration: none; color: black;">
                                            <h4 class="panel-title">
                                                {{ $question->question }}
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="el{{ $question->id }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @isset($question->answer)
                                                <p>
                                                    {{ $question->answer }}
                                                </p>
                                            @endisset

                                            @auth
                                                @empty($question->answer)
                                                    <form action="{{ route('questions.reply', $question->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}

                                                        @include('fields.textarea', ['field' => 'answer', 'name' => 'Answer', 'rows' => 10])

                                                        <div class="row form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endempty
                                            @endauth

                                            <p>
                                                Author of question: {{ $question->author->name }}
                                            </p>
                                            <p>
                                                Email: {{ $question->author->email }}
                                            </p>
                                            <p>
                                                Date: {{ $question->created_at }}
                                            </p>

                                            @auth
                                                @if(!empty($question->answer))
                                                    <form class="inline-form" action="{{ route('questions.publish', $question->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <button type="submit" name="publish" class="btn btn-primary" value="@if($question->is_published){{ 'unpublish' }}@else{{ 'publish' }}@endif">@if($question->is_published){{ 'Unpublish' }}@else{{ 'Publish' }}@endif</button>
                                                    </form>
                                                @endif

                                                <div class="dropdown inline-form">
                                                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Edit <b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('questions.edit', $question->id) }}">Question</a></li>
                                                        <li><a href="{{ route('authors.edit', $question->author->id) }}">Author</a></li>
                                                    </ul>
                                                </div>

                                                <form class="inline-form" action="{{ route('questions.changeCategory', $question->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    @include('fields.select_inline', ['field' => 'category_id', 'options' => $categories])
                                                    <button type="submit" class="btn btn-primary">Remove</button>
                                                </form>

                                                <form class="inline-form" action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif

                @auth
                    @if($activeCategory)
                        <form action="{{ route('categories.destroy', $activeCategory->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete category</button>
                        </form>
                    @endif
                @endauth

            </div>

        </div>

        @guest
            @include('face.question_form', ['categories' => $categories])
        @endguest
    @endif


</div>
@endsection
