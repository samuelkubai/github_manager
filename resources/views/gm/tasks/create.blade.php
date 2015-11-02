@extends('layout')

@section('content')
        <!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3>
            <i class="fa fa-angle-right"></i> Create a new task.

        </h3>
        <br>
        <div class="row">
            <form action="{{ url('/store/task') }}" method="post">
                <div class="form-group">
                    <label class="col-sm-6 col-sm-6 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>

                <label class="col-sm-6 col-sm-6 control-label">Select the project for the task</label>

                <select class="form-control" name="project">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>

                <br>
                <br>
                <button type="submit" class="btn btn-block btn-theme text-center"><i class="fa fa-plus"> Create</i></button>
            </form>
        </div>
    </section>
</section>
@endsection

