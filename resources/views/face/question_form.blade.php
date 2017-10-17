<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">Create new question</div>

            <div class="panel-body">
                <form action="{{ route('questions.store') }}" method="POST">
                    {{ csrf_field() }}

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