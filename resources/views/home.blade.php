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
                <div class="panel-heading">Create New Poll</div>

                    <div class="panel-body">


                        {{ Form::open(array('action' => array('PollController@create', Auth::id()))) }}

                            <div class="form-group" id="general">

                                <!-- course title -->
                                {{ Form::label('title', 'Name Your Poll:') }}<br />
                                {{ Form::text('title') }}<br />

                                <!-- course description -->
                                {{ Form::label('description', 'Optional Description:') }}<br />
                                {{ Form::textarea('description') }}<br />

                            </div>

                            <div class="form-group" id="questions">

                                <hr />

                                <!-- question 1 -->
                                {{ Form::label('question1', 'Question #1:') }}<br />
                                {{ Form::text('question1', '', array('class' => 'question')) }}


                                <ul>

                                    <li>
                                    <!-- q1 a1 -->
                                    {{ Form::label('question1answer1', 'Q1 Answer #1:') }}<br />
                                    {{ Form::text('question1answer1') }}<br />
                                    </li>


                                    <li>
                                        {{ Form::button('Add Answer', array('class' => 'addAnswer', 'id' =>
                                        'addAnswer1')) }}
                                    </li>

                                </ul>


                                {{ Form::button('Add Question', array('id' => 'addQuestion')) }}

                            </div>

                            <div class="form-group" id="submit">
                                {{ Form::submit('Create Poll') }}
                            </div>

                        {{ Form::close() }}
                    </div>
                </div>



                <div class="panel panel-default">
                    <div class="panel-heading">My Polls</div>

                    <div class="panel-body">

                        <table border="1">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Questions</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($polls as $poll)
                            <tr>
                                <td>{{ $poll->title }}</td>
                                <td>{{ $poll->description }}</td>
                                <td>{{ $poll->questionCount() }}</td>
                                <td><a href="/poll/edit/{{ $poll->id }}">edit</a> | <a href="/poll/delete/{{ $poll->id }}">delete</a></td>
                            </tr>
                        @endforeach
                        </table>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script src="js/pollForm.js"></script>

@endsection
