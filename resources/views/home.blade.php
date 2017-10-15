@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="panel-group" id="collapse-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#collapse-group" href="#el1" style="text-decoration: none; color: black;">
                    <h4 class="panel-title">Первый элемент</h4>
                </a>
            </div>
            <div id="el1" class="panel-collapse collapse in">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#collapse-group" href="#el2">Второй элемент</a>
                </h4>
            </div>
            <div id="el2" class="panel-collapse collapse">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#collapse-group" href="#el3">Третий элемент</a>
                </h4>
            </div>
            <div id="el3" class="panel-collapse collapse">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            </div>
        </div>
    </div>
</div>
@endsection
