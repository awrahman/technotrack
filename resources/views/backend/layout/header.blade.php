 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">

      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
              @php($order= \App\order::where('order_status',0)->latest()->get())
              @php($message= \App\website_message::where('status',1)->get())
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          @if(count($order)+count($message) > 0)
          <i class="far fa-bell faa-ring animated faa-slow" style="color:#fe372b"></i>
          <span id="message_count" class="badge badge-info navbar-badge rounded-circle">{{count($order)+count($message)}}</span>
          @else
          <i class="far fa-bell"></i>
          <span id="message_count" class="badge badge-warning navbar-badge">0</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{route('admin.order.index')}}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{count($order)}} new Order

          </a>
          <a href="{{route('admin.messages')}}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{count($message)}} new messages

          </a>
        </div>
      </li>

    </ul>
  </nav>

  <!-- /.navbar -->
