@extends('layouts.app')

@section('content')
<div class="container content">

    @if($categories->count() > 0)
        <div class="row">
            {{--<nav class="col-md-4" id="myScrollspy">--}}

                {{--<ul class="nav nav-pills nav-stacked">--}}
                    {{--<li class="active"><a href="#section1">Section 1</a></li>--}}
                    {{--<li><a href="#section2">Section 2</a></li>--}}
                    {{--<li><a href="#section3">Section 3</a></li>--}}
                {{--</ul>--}}

            {{--</nav>--}}

            <div class="col-md-4">

                <div class="list-group">
                    @foreach($categories as $category)
                        <a href="{{ route('home', $category->id) }}" class="list-group-item @if($activeCategory && $activeCategory->id === $category->id){{  'active' }}@endif">
                            {{ $category->title }}
                        </a>
                    @endforeach
                </div>

            </div>

            <div class="col-md-7 col-md-offset-1">

                @if($activeCategory->questions->count() > 0)
                    <div id="section" class="panel-group">
                        @foreach($activeCategory->questions as $question)
                            <div class="panel panel-default">
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
                                        <p>
                                            Author: {{ $question->author->name }}
                                        </p>
                                        <p>
                                            Email: {{ $question->author->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
            </div>

        </div>

        @guest
            @include('face.question_form', ['categories' => $categories])
        @endguest
    @endif


</div>
@endsection
