@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    @if(empty($category))
                        <div class="panel-heading">Create new category</div>
                    @else
                        <div class="panel-heading">Edit category</div>
                    @endif

                    <div class="panel-body">
                        <form action="@if(empty($category)){{ route('categories.store') }}@else{{ route('categories.update', $category->id) }}@endif" method="POST">
                            {{ csrf_field() }}

                            @isset($category)
                                {{ method_field('PUT') }}
                            @endisset

                            @include('fields.text', ['field' => 'title', 'name' => 'Category', 'entity' => isset($category) ? $category : null]);

                            <div class="row form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>

                                    @isset($category)
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endisset
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


