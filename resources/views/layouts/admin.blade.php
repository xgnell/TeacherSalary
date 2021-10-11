<?php
  $menu = config('menu');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage salary</title>
    @yield('css')
   
<script src=//code.jquery.com/jquery-3.5.1.min.js integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin=anonymous></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/ad/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('public/ad/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/ad/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('public/ad/chart/highchart.css') }}">
    <script src="{{ asset('public/ad/plugins/jquery/jquery.min.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">Hi {{ Auth::user()->name }}</a>
          <ul class="dropdown-menu">
            {{-- <li><a href="">Thông Tin</a></li> --}}
            <li><a href="{{ route('logout') }}" Onclick="return confirm('Are you sure you want to logout')">Thoát tài khoản</a></li>
          </ul>
        </li>
      </ul>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        </a>
        
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('public/ad/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Manage Salary</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('public/upload') }}/{{Auth::user()->image}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              @foreach ($menu as $item)
                  <li class="nav-item">
            <a href="{{ route($item['route']) }}" class="nav-link">
              <i class="nav-icon fas {{ $item['icon']}}"></i>
              <p>
                {{ $item['label'] }}
            @if (isset($item['items']))
                <i class="right fas fa-angle-left"></i>
            @endif
              </p>
            </a>
            @if (isset($item['items']))
                <ul class="nav nav-treeview">
                  @foreach ($item['items'] as $m)
                      <li class="nav-item">
                <a href="{{ route($m['route']) }}" class="nav-link">
                  <i class="far {{$m['icon']}} nav-icon"></i>
                  <p>{{ $m['label'] }}</p>
                </a>
              </li>
                  @endforeach
            </ul>
          </li>
          {{-- end category --}}
            @endif         
              @endforeach
              {{-- account --}}
              @if (Auth::user()->role ==1)
              <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Account
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                    <ul class="nav nav-treeview">
                          <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List Account</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.create') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Account</p>
                    </a>
                  </li>
                      
                </ul>
              </li>
              @endif
            
      {{-- end category --}}
        
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
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
             
              <div class="card-body">
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                      {{ Session::get('error') }}
                  </div>
                @endif
                  @if (Session::has('success'))
                      <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                  @endif
                @yield('main')
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="{{ asset('public/ad/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/ad/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/ad/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/ad/dist/js/demo.js') }}"></script>
@yield('js')
</body>
</html>