<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mogul Limited</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/momentjs/2.13.0/moment.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->

        <div class="input-group input-group-sm col-md-4">
            <input class="form-control form-control-navbar"  v-model="search" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" >
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">


            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" v-pre>
                     <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item">
                        
                    </a>
                   
                    <form id="logout-form" action="" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                            class="fa fa-th-large"></i></a>
            </li>

        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('/img/mogul.png') }}" alt="mLogo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Mogul Limited</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('/img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"></a>
                    <p>
                        <a href="#" class="d-block"></a>
                    </p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                
                    <li class="nav-item">
                        <router-link to="/orders" class="nav-link">
                            <i class="nav-icon fas fa-folder-open orange"></i>
                            <p>
                                Order
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/fleet" class="nav-link">
                            <i class="nav-icon fas fa-folder-open orange"></i>
                            <p>
                                Fleet Managment
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/delivery" class="nav-link">
                            <i class="nav-icon fas fa-folder-open orange"></i>
                            <p>
                                Delivery
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/location" class="nav-link">
                            <i class="nav-icon fas fa-folder-open orange"></i>
                            <p>
                                location
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/vehicleStatus" class="nav-link">
                            <i class="nav-icon fas fa-folder-open orange"></i>
                            <p>
                                Vehicle Status
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/deliveryStatus" class="nav-link">
                            <i class="nav-icon fas fa-folder-open orange"></i>
                            <p>
                                Delivery Status
                            </p>
                        </router-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <router-view></router-view>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">

        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2022-{{ now()->year }} <a href="#">Mogul.ltd</a>.</strong>All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->




{{--<script src="/js/app.js"></script>--}}
<!-- jQuery -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
