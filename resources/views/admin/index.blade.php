@include('admin.layouts.header')
@include('admin.layouts.nav')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">
        @include('admin.layouts.message')
        @yield('content')

    </section>
    <!-- /.content -->
</div>


@include('admin.layouts.footer')



