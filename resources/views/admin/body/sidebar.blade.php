<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">

    <div class="user-profile">
      <div class="ulogo">
        <a href="index.html">
          <!-- logo for regular state and mobile devices -->
          <div class="d-flex align-items-center justify-content-center">
            <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
            <h3><b>Easy</b> Shop</h3>
          </div>
        </a>
      </div>
    </div>

    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{url('admin/dashboard')}}">
          <i data-feather="pie-chart"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview {{ Request::routeIs('all.brands') ? 'active' : '' }}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Brands</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('all.brands') ? 'active' : '' }}"><a href="{{route('all.brands')}}"><i class="ti-more"></i>All Brands</a></li>
          
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="mail"></i> <span>Category</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('all.category') ? 'active' : '' }}" ><a href="{{route('all.category')}}"><i class="ti-more"></i>All Category</a></li>
          <li class="{{Request::routeIs('all.subCategory') ? 'active' : '' }}"><a href="{{route('all.subCategory')}}"><i class="ti-more"></i>All Sub Category</a></li>
          <li class="{{Request::routeIs('all.subsubCategory') ? 'active' : '' }}"><a href="{{route('all.subsubCategory')}}"><i class="ti-more"></i>All Sub-sub Category</a></li>

        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Product</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('add.product') ? 'active' : '' }}"><a href="{{route('add.product')}}"><i class="ti-more"></i>Add Product</a></li>
          <li class="{{ Request::routeIs('manage.product') ? 'active' : '' }}"><a href="{{route('manage.product')}}"><i class="ti-more"></i>Manage Product</a></li>
        </ul>
      </li>


      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Slider</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('manage.slider') ? 'active' : '' }}"><a href="{{route('manage.slider')}}"><i class="ti-more"></i>Manage Slider</a></li>

        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Coupons</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('manage.coupons') ? 'active' : '' }}"><a href="{{route('manage.coupons')}}"><i class="ti-more"></i>Manage Coupons</a></li>

        </ul>
      </li>

      <li class="header nav-small-cap">User Interface</li>

      <li class="treeview">
        <a href="#">
          <i data-feather="grid"></i>
          <span>Components</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
          <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
          <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
          <li><a href="components_sliders.html"><i class="ti-more"></i>Sliders</a></li>
          <li><a href="components_dropdown.html"><i class="ti-more"></i>Dropdown</a></li>
          <li><a href="components_modals.html"><i class="ti-more"></i>Modal</a></li>
          <li><a href="components_nestable.html"><i class="ti-more"></i>Nestable</a></li>
          <li><a href="components_progress_bars.html"><i class="ti-more"></i>Progress Bars</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="credit-card"></i>
          <span>Cards</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
          <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
          <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
        </ul>
      </li>
      

    </ul>
  </section>

  <div class="sidebar-footer">
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
      aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
    <!-- item-->
    <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
        class="ti-email"></i></a>
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
        class="ti-lock"></i></a>
  </div>
</aside>