<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') | Khuti Nati</title>
  <link rel="icon" href="{{ asset('img/logo.png') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  @yield('pageStyles')
</head>

<body>
  <header class="fixed-top">
    <nav class="navbar navbar-expand navbar-light navbar-top">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">About us</a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link"
              href="@if(in_array(auth()->user()->role, [1,2])) {{ route('admin.account') }} @else {{ route('user.account') }} @endif">
              My account
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="logoutBtn" href="#" title="Log out">
              Logout
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logoutForm" class="d-none">
              @csrf
            </form>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              Login
            </a>
          </li>
          @endauth
        </ul>
      </div>
    </nav>
    <nav class="navbar navbar-expand navbar-light navbar-main">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item pe-2">
            <a class="navbar-brand" href="/">
              <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-search">
          <li class="nav-item ps-2 pe-2 w-100">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search products" aria-label="Recipient's username"
                aria-describedby="button-addon2">
              <button class="btn" type="button" id="button-addon2">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item ps-2">
            <a class="nav-link navbar-cart-icon text-center" href="javascript:void(0)" data-cart-open-btn>
              <i class="fa-solid fa-cart-shopping"></i>
              <span class="badge bg-danger"></span>
              <div class="fw-bold" data-cart-total>৳ 0</div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="sidebar-cart sidebar" data-sidebar-cart>
    <div class="sidebar-cart-header">
      <h4>My Cart</h4>
      <a href="javascript:void(0)" class="link-secondary cart-close" data-cart-close-btn>
        <i class="fa-solid fa-xmark"></i>
      </a>
    </div>
    <div class="sidebar-cart-body" data-cart-container>
      <div class="empty-cart" data-cart-empty>
        Your Cart is empty
      </div>
    </div>
    <div class="sidebar-cart-footer">
      <button class="btn btn-primary w-100 h-100 d-flex flex-row">
        <div class="w-50 text-center fw-bold">CHECKOUT</div>
        <div class="w-50 text-center fw-bold font-2" data-cart-total>৳ 0</div>
      </button>
    </div>
  </aside>

  <main>
    @yield('main')
  </main>

  <div class="footer"></div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    document.querySelector("#logoutBtn")?.addEventListener('click', () => {
      document.querySelector('#logoutForm').submit()
    })
  </script>
  @yield('pageScripts')
</body>

</html>