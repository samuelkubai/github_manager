@extends('layout')

@section('content')
        <!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3>
            <i class="fa fa-angle-right"></i> All current projects
            <span class="pull-right">
                <a href="{{ url('/create/project') }}" class="btn btn-primary btn-rounded">Create Project <i class="fa fa-plus"></i></a>
            </span>
        </h3>
        <br>
         <div class="row">

            <div class="col-md-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Projects Details</h4>
                    <hr>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>

                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td><a href="{{ url('edit/project/'.$project->id) }}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>
                                <td><a href="{{ url('delete/project/'.$project->id) }}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a></td>
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

