@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Edit author</div>

                    <div class="panel-body">
                        <form action="{{ route('authors.update', $author->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            @include('fields.text', ['field' => 'name', 'name' => 'Authors name', 'entity' => $author]);
                            @include('fields.text', ['field' => 'email', 'name' => 'Authors email', 'entity' => $author]);

                            <div class="row form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
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


