@include('partials.header')

<section id="container" >
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="/" class="logo"><b>Github Manager</b></a>
        <!--logo end-->

        <!-- Logout -->
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="{{ '/logout' }}">Logout</a></li>
            </ul>
        </div>
        <!-- Logout Ends -->
    </header>
    <!--header end-->
    @include('partials.sidebar')

    <!--main content start-->
    @yield('content')
    <!--main content end-->

</section>
@include('partials.footer')
