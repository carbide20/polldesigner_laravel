@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Edit Poll</div>

                    <div class="panel-body">


                        {{ Form::model($poll, array('action' => array('PollController@update', $poll->id))) }}

                            <!-- course title -->
                            {{ Form::label('title', 'Name Your Poll:') }}<br />
                            {{ Form::text('title') }}<br />

                            <!-- course description -->
                            {{ Form::label('description', 'Optional Description:') }}<br />
                            {{ Form::textarea('description') }}<br />


                            {{ Form::submit('Save Poll') }}

                        {{ Form::close() }}
                    </div>
                </div>


            </div>

        </div>

    </div>
</div>
@endsection
