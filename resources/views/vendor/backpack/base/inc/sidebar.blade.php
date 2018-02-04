@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        @include('backpack::inc.sidebar_user_panel')

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          {{-- <li class="header">{{ trans('backpack::base.administration') }}</li> --}}
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ backpack_url('order') }}"><i class="fa fa-tag"></i> <span>Order</span></a></li>
          <li><a href="{{ backpack_url('service') }}"><i class="fa fa-tag"></i> <span>Manage Service</span></a></li>
          <li><a href="{{ backpack_url('material') }}"><i class="fa fa-tag"></i> <span>Manage Material</span></a></li>

          <!-- ======================================= -->
          <li class="header">Settings</li>

          <li><a href="{{ backpack_url('admin') }}"><i class="fa fa-tag"></i> <span>Manage Admin</span></a></li>
          <li><a href="{{ backpack_url('technician') }}"><i class="fa fa-tag"></i> <span>Manage Technician</span></a></li>
          <li><a href="{{ backpack_url('client') }}"><i class="fa fa-tag"></i> <span>Manage Client</span></a></li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
