@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    @if(empty($user))
                        <div class="panel-heading">Create new user</div>
                    @else
                        <div class="panel-heading">Edit user</div>
                    @endif

                    <div class="panel-body">
                        <form action="@if(empty($user)){{ route('users.store') }}@else{{ route('users.update', $user->id) }}@endif" method="POST">
                            {{ csrf_field() }}

                            @isset($user)
                                {{ method_field('PUT') }}
                            @endisset

                            @include('fields.text', ['field' => 'login', 'name' => 'Login', 'entity' => isset($user) ? $user : null]);
                            @include('fields.password', ['field' => 'password', 'name' => 'Password']);
                            @include('fields.password_confirm', ['name' => 'Confirm Password']);

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


