@extends('layout')

@section('content')
        <!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Welcome {{ \Auth::user()->username }}</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <p>Continue with the experience your friends has already been invited.</p>
                <p>
                    <a href="{{ url('/all/tasks') }}" class="btn btn-theme">View Your Tasks <i class="fa fa-th"></i></a>
                    &nbsp;
                    <a href="{{ url('/all/projects') }}" class="btn btn-theme02">View Your Projects <i class="fa fa-book"></i></a>
                </p>
            </div>
        </div>
    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
@endsection

