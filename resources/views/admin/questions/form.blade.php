@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Edit question</div>

                    <div class="panel-body">
                        <form action="{{ route('questions.update', $question->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            @include('fields.textarea', ['field' => 'question', 'name' => 'Question', 'rows' => 10, 'entity' => $question]);
                            @include('fields.textarea', ['field' => 'answer', 'name' => 'Answer', 'rows' => 10, 'entity' => isset($question) ? $question : null]);

                            <div class="row form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" name="update_question" value="true" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


