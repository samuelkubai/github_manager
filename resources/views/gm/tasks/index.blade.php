@extends('layout')

@section('content')
        <!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3>
            <i class="fa fa-angle-right"></i> All tasks for the user
            <span class="pull-right">
                <a href="{{ url('/create/task') }}" class="btn btn-theme02 btn-rounded">Create Task <i class="fa fa-plus"></i></a>
            </span>
        </h3>
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Tasks Details</h4>
                    <hr>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Assignee</th>
                            <th>Project</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>

                                <td>{{ $task->name }}</td>
                                <td>{{ $task->user->username }}</td>
                                <td>{{ $task->project->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <! --/content-panel -->
            </div>
            <!-- /col-md-12 -->
        </div>
    </section>
</section>
@endsection

