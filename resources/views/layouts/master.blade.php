<!DOCTYPE html>
<html>
@include("layouts.head")

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include("layouts.Navbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("layouts.Main-Sidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
     @include("layouts.main-header")
        <!-- /.content-header -->

        <!-- Main content -->
      @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
   @include("layouts.footer")

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
   @include("layouts.footer-scripts")
@yield('scripts')
</body>
</html>
