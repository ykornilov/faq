@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Questions without answer</div>

                    <div class="panel-body">
                        @if($questions->count() > 0)
                            <table class="table">
                                <tr>
                                    <th>Question</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ $question->created_at }}</td>
                                        <td>
                                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                                <a type="button" class="btn btn-primary" href="{{ route('questions.edit', $question->id) }}">Edit</a>
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            No users
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection