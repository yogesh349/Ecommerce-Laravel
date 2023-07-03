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

      @php
        $brand = (auth()->guard('admin')->user()->brandd == 1);
        $category = (auth()->guard('admin')->user()->category == 1);
        $product = (auth()->guard('admin')->user()->product == 1);
        $slider = (auth()->guard('admin')->user()->slider == 1);
        $coupons = (auth()->guard('admin')->user()->coupons == 1);
        $shipping = (auth()->guard('admin')->user()->shipping == 1);
        $blog = (auth()->guard('admin')->user()->blog == 1);
        $setting = (auth()->guard('admin')->user()->setting == 1);
        $returnorder = (auth()->guard('admin')->user()->returnorder == 1);
        $review = (auth()->guard('admin')->user()->review == 1);
        $orders = (auth()->guard('admin')->user()->orders == 1);
        $stock = (auth()->guard('admin')->user()->stock == 1);
        $reports = (auth()->guard('admin')->user()->reports == 1);
        $alluser = (auth()->guard('admin')->user()->alluser == 1);
        $adminuserrole = (auth()->guard('admin')->user()->adminuserrole == 1);
        @endphp



   @if($brand == true) 
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

      @else
      @endif



      @if($category == true)
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
      @else
      @endif


      @if($product == true)
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
      
      @else
      @endif



      @if($slider == true)
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
      @else
      @endif


      @if($coupons == true)
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
      @else
      @endif


    @if($shipping == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Shipping Area</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('manage.division') ? 'active' : '' }}"><a href="{{route('manage.division')}}"><i class="ti-more"></i>Ship Province</a></li>
          <li class="{{ Request::routeIs('manage.district') ? 'active' : '' }}"><a href="{{route('manage.district')}}"><i class="ti-more"></i>Ship District</a></li>
          <li class="{{ Request::routeIs('manage.district') ? 'active' : '' }}"><a href="{{route('manage.city')}}"><i class="ti-more"></i>Ship City</a></li>

        </ul>
      </li>
      @else
      @endif



      @if($blog == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Manage Blog</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('blog.category') ? 'active' : '' }}"><a href="{{route('blog.category')}}"><i class="ti-more"></i>Blog Category</a></li>
          <li class="{{ Request::routeIs('list.post') ? 'active' : '' }}"><a href="{{route('list.post')}}"><i class="ti-more"></i>List Blog Post</a></li>
          <li class="{{ Request::routeIs('add.post') ? 'active' : '' }}"><a href="{{route('add.post')}}"><i class="ti-more"></i>Add Blog Post</a></li>

        </ul>
      </li>
      @else
      @endif



      @if($setting == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Manage Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('site.setting') ? 'active' : '' }}"><a href="{{route('site.setting')}}"><i class="ti-more"></i>Site Setting</a></li>
          <li class="{{ Request::routeIs('seo.setting') ? 'active' : '' }}"><a href="{{route('seo.setting')}}"><i class="ti-more"></i>Seo Setting</a></li>
        </ul>
      </li>
      @else
      @endif


      @if($returnorder == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Return Order</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('return.request') ? 'active' : '' }}"><a href="{{route('return.request')}}"><i class="ti-more"></i>Return Request</a></li>
          <li class="{{ Request::routeIs('all.request') ? 'active' : '' }}"><a href="{{route('all.request')}}"><i class="ti-more"></i>All Request</a></li>
        </ul>
      </li>

      @else
      @endif


      @if($review == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Manage</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('pending.review') ? 'active' : '' }}"><a href="{{route('pending.review')}}"><i class="ti-more"></i>Pending Review</a></li>

          <li class="{{ Request::routeIs('publish.review') ? 'active' : '' }}"><a href="{{route('publish.review')}}"><i class="ti-more"></i>Publish Review</a></li>
        </ul>
      </li>

      @else
      @endif




      



      <li class="header nav-small-cap">User Interface</li>


      @if($orders == true)

      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Orders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('pending-orders') ? 'active' : '' }}"><a href="{{route('pending-orders')}}"><i class="ti-more"></i>Pending Orders</a></li>
          <li class="{{ Request::routeIs('confirmed-orders') ? 'active' : '' }}"><a href="{{route('confirmed-orders')}}"><i class="ti-more"></i>Confirmed Orders</a></li>
          <li class="{{ Request::routeIs('processing-orders') ? 'active' : '' }}"><a href="{{route('processing-orders')}}"><i class="ti-more"></i>Processing Orders</a></li>
          <li class="{{ Request::routeIs('picked-orders') ? 'active' : '' }}"><a href="{{route('picked-orders')}}"><i class="ti-more"></i>Picked Orders</a></li>
          <li class="{{ Request::routeIs('shipped-orders') ? 'active' : '' }}"><a href="{{route('shipped-orders')}}"><i class="ti-more"></i>Shipped Orders</a></li>
          <li class="{{ Request::routeIs('delivered-orders') ? 'active' : '' }}"><a href="{{route('delivered-orders')}}"><i class="ti-more"></i>Delivered Orders</a></li>
          <li class="{{ Request::routeIs('cancel-orders') ? 'active' : '' }}"><a href="{{route('cancel-orders')}}"><i class="ti-more"></i>Cancelled Orders</a></li>
        </ul>
      </li>
      
      @else
      @endif

      @if($reports == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>All Reports</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('all-reports') ? 'active' : '' }}"><a href="{{route('all-reports')}}"><i class="ti-more"></i> All Reports</a></li>
          
        </ul>
      </li>
            
      @else
      @endif

      @if($stock == true)

      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Manage Stock</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('product.stock') ? 'active' : '' }}"><a href="{{route('product.stock')}}"><i class="ti-more"></i> Product Stock</a></li>
          
        </ul>
      </li>

      @else
      @endif


      
     @if($alluser == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>All Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('all-users') ? 'active' : '' }}"><a href="{{route('all-users')}}"><i class="ti-more"></i> All Users</a></li>
          
        </ul>
      </li>

      @else
      @endif
 

      @if($adminuserrole == true)
      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Admin User Role</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::routeIs('all.admin.user') ? 'active' : '' }}"><a href="{{route('all.admin.user')}}"><i class="ti-more"></i> All Admin User</a></li>
          
        </ul>
      </li>
      
      @else
      @endif
 

      

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