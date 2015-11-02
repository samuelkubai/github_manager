@extends('layout')

@section('content')
        <!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3>
            <i class="fa fa-angle-right"></i> Create a new project.

        </h3>
        <br>
        <div class="row">
            <form action="{{ url('/store/project') }}" method="post">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" name="description" class="form-control">
                    </div>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-block btn-theme text-center"><i class="fa fa-plus"> Create</i></button>
            </form>
        </div>
    </section>
</section>
@endsection

