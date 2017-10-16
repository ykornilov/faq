<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            @if(empty($question))
                <div class="panel-heading">Create new question</div>
            @else
                <div class="panel-heading">Edit question</div>
            @endif

            <div class="panel-body">
                <form action="@if(empty($question)){{ route('questions.store') }}@else{{ route('questions.update', $question->id) }}@endif" method="POST">
                    {{ csrf_field() }}

                    @isset($question)
                        {{ method_field('PUT') }}
                    @endisset

                    @include('fields.text', ['field' => 'name', 'name' => 'Your name'])
                    @include('fields.text', ['field' => 'email', 'name' => 'Your email'])
                    @include('fields.textarea', ['field' => 'question', 'name' => 'Question', 'rows' => 10])
                    @include('fields.select', ['field' => 'category_id', 'name' => 'Category', 'options' => $categories])

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