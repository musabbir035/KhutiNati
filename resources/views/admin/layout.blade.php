<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    @if(View::hasSection('title'))
    @yield('title') | Khuti Nati Admin
    @else
    Khuti Nati Admin
    @endif
  </title>
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  @livewireStyles
  @yield('pageStyles')
  @yield('livewireViewStyles')
</head>

<body>
  <div class="sidebar">
    <div class="sidebar-header">
      <a href="{{ route('admin.dashboard') }}" class="link-primary">Khuti Nati Admin</a>
      <a href="#" id="sidebarClose" class="text-secondary sidebar-close-btn">
        <i class="fa-solid fa-xmark"></i>
      </a>
    </div>
    <ul class="sidebar-nav">
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}"
          class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
          <i class="fa-solid fa-gauge-high"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.users.index') }}"
          class="nav-link {{ request()->is('admin/users*') || request()->is('admin/account') || request()->is('change-password') ? 'active' : '' }}">
          <i class="fa-solid fa-users"></i>
          Users
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.categories.index') }}"
          class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
          <i class="fa-solid fa-list"></i>
          Categories
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.products.index') }}"
          class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
          <i class="fa-solid fa-boxes-stacked"></i>
          Products
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.sellers.index') }}"
          class="nav-link {{ request()->is('admin/sellers*') ? 'active' : '' }}">
          <i class="fa-solid fa-shop"></i>
          Sellers
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.orders.index') }}"
          class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
          <i class="fa-solid fa-file-invoice-dollar"></i>
          Orders
        </a>
      </li>
    </ul>
  </div>
  <div class="main">
    <nav class="navbar navbar-expand navbar-light bg-light fixed-top navbar-admin">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <a class="nav-link" href="#" id="sidebarToggle"><i class="fas fa-bars"></i></a>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item" id="mobileNavbarNotification">
              <a class="nav-link position-relative" href="#"><i class="fas fa-bell"></i>
                <span class="badge bg-danger notification-badge"></span>
              </a>
            </li>
            <li class="nav-item dropdown" id="desktopNavbarNotification">
              <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="badge bg-danger notification-badge">2</span>
              </a>
              <div class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown">
                <div class="notification-dropdown-heaeder">
                  You have <span id="unreadCount"></span> unread notifications
                </div>
                <div class="notification-dropdown-body">
                </div>
                <div class="notification-dropdown-footer">
                  <a href="#" class="td-none">See all notifications</a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('admin.account') }}">
                    <i class="fa-solid fa-user"></i> My Account
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('admin.users.edit', ['user' => auth()->id()]) }}">
                    <i class="fa-solid fa-user-pen"></i> Edit Account
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('change-password') }}">
                    <i class="fa-solid fa-key"></i> Change Password
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#" id="logoutBtn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                  </a>
                  <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="main-content">
      @yield('main')
    </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/push.js') }}"></script>
  <script src="//js.pusher.com/3.1/pusher.min.js"></script>
  <script>
    // shows success and error messages
    if('{{ session("message") }}' !== '') {
      let variant = '{{ session("code") }}' == 200 ? 'success' : 'danger';
      showFlashMessage('{{session("title")}}', '{{ session("message") }}', variant);
    }

    // handles logout
    document.querySelector("#logoutBtn")?.addEventListener('click', () => {
      document.querySelector('#logoutForm').submit()
    })

    let notifSkip = 0;
    let notifDropdown = document.querySelector('.notification-dropdown-body');
    // get notifications
    axios.get(`/notifications?skip=${notifSkip}`).then((res) => {
      res.data.notifications.forEach(el => {
        // populate notifications dropdown
        createNotifElement(el, notifDropdown)
      });

      document.querySelector('#unreadCount').innerText = res.data.unread_count;
      setNotificationBadgeCount(res.data.uncheck_count);
    });

    // reset notification badge on top right corner of the bell icon
    // when bell icon is clicked
    let notificationDropdownBtn = document.querySelector('#notificationDropdown');
    notificationDropdownBtn.addEventListener('click', () => {
      notificationChecked('{{ auth()->id() }}');
    })

    // subscribe to channels for real time notifications
    let channel = pusher.subscribe("private-admin-notification");
    channel.bind("pusher:subscription_succeeded", function (members) {
      //console.log("successfully subscribed!");
    });

    // when a real time notification is received create notification DOM element
    // and add that to the notification dropdown
    channel.bind("admin-notification-event", function (data) {
      createNotifElement(data, notifDropdown);
    });    
  </script>
  @livewireScripts
  @yield('livewireViewScripts')
  @yield('pageScripts')
</body>

</html>