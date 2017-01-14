<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Learn Laravel">
    <meta name="author" content="Bach Trung Kien">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap Core CSS -->
    {!! Html::style(elixir('bower_components/bootstrap/dist/css/bootstrap.min.css')) !!}
    <!-- Custom CSS -->
    {!! Html::style(elixir('css/sb-admin-2.css')) !!}
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    {!! Html::style(elixir('css/dataTables.responsive.css')) !!}
    <!-- Custom Fonts -->
    {!! Html::style(elixir('bower_components/font-awesome/css/font-awesome.min.css')) !!}
    @yield("sc_head")
</head>

<body>

<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">{{ config('app.name') }}</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    {{ Auth::user()->name }}<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ action('ProfileController@edit', Auth::id()) }}">{{ trans('user.profileUser') }} <i class="fa fa-user fa-fw"></i> </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                       <a href="{{ action('Auth\LoginController@logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ trans('auth.logout') }} <i class="fa fa-sign-out fa-fw"></i>
                        </a>
                        <form id="logout-form" action="{{ action('Auth\LoginController@logout') }}" 
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-bar-chart-o fa-fw"></i> 
                            {{ trans('user.admin.category') }} 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ action('Admin\CategoryController@index') }}">{{ trans('user.admin.listCate') }}</a>
                            </li>
                            <li>
                                <a href="{{ action('Admin\CategoryController@create') }}">{{ trans('user.admin.addCate') }}</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cube fa-fw"></i> {{ trans('user.admin.word') }} <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ action('Admin\WordController@index') }}">{{ trans('user.admin.listWord') }}</a>
                            </li>
                            <li>
                                <a href="{{ action('Admin\WordController@create') }}">{{ trans('user.admin.addWord') }}</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i>{{ trans('user.admin.user1') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ action('Admin\UserController@index') }}">{{ trans('user.admin.listUser') }}</a>
                            </li>
                            <li>
                                <a href="{{ action('Admin\UserController@create') }}">{{ trans('user.admin.addUser') }}</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>@yield('cate')</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                </div>
                    @yield('content')
                <div class="col-lg-offset-1 col-lg-4">
                    @yield('sub-img')
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
{!! Html::script(elixir('bower_components/bootstrap/dist/js/bootstrap.min.js')) !!}

<!-- Metis Menu Plugin JavaScript -->
{!! Html::script(elixir('bower_components/metisMenu/dist/metisMenu.min.js')) !!}

<!-- Custom Theme JavaScript -->
{!! Html::script(elixir('js/sb-admin-2.js')) !!}
{!! Html::script(elixir('js/deleteResouce.js')) !!}
<!-- DataTables JavaScript -->
{!! Html::script(elixir('bower_components/datatables.net/js/jquery.dataTables.min.js')) !!}
{!! Html::script(elixir('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')) !!}
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
        $('.dataTables_paginate, .dataTables_info, .dataTables_length').hide();
    });
</script>
@yield('sc')
</body>

</html>
