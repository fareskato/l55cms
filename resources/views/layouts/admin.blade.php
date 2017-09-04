<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('admin.partials.styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        @include('admin.partials.logo')
        <!-- Header Navbar: style can be found in header.less -->
        @include('admin.partials.navTop')
    </header>
    <!-- Left side column. contains the logo and sidebar -->
        @include('admin.partials.sideBar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.pageHeader')

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.partials.footer')

    <!-- Control Sidebar -->
    @include('admin.partials.sideBar')
    <div class="control-sidebar-bg" style="display: none"></div>
</div>

@include('admin.partials.scripts')

</body>
</html>
