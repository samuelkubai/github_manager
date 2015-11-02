<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="#"><img src="{{ \Auth::user()->avatar }}" class="img-circle" width="60"></a></p>
             <h5 class="centered">{{ \Auth::user()->username }}</h5>

            <li class="mt">
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="{{ url('/all/projects') }}" >
                    <i class="fa fa-book"></i>
                    <span>Projects</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="{{ url('/all/tasks') }}" >
                    <i class="fa fa-th"></i>
                    <span>Tasks</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->