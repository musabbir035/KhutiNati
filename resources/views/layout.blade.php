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
  <header class="fixed-top" data-fixed-haeder>
    <nav class="navbar navbar-expand navbar-light navbar-top">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
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
    <nav class="navbar navbar-expand navbar-light navbar-main justify-content-around">
      <div class="row w-100">
        <div class="col-9 col-md-4 d-flex order-1 order-md-first">
          <ul class="navbar-nav me-auto">
            <li class="nav-item pe-2">
              <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo.png') }}" alt="">
              </a>
            </li>
            @if(!request()->is('/'))
            <li class="nav-item ps-2 position-relative">
              <a class="nav-link font-2" href="#" role="button" data-category-dropdown>
                Categories <i class="fa-solid fa-angle-down"></i>
              </a>
              <div class="navbar-category-dropdown shadow" data-category-dropdown-menu>
                <ul>
                  @include('main.menu.category-menu')
                </ul>
              </div>
            </li>
            @endif
          </ul>
        </div>
        <div class="col-12 col-md-7 d-flex order-first order-md-1 mt-2 mt-md-0 mb-2 md-md-0">
          <ul class="navbar-nav navbar-search float-end w-100">
            <li class="nav-item ps-2 pe-2 w-100 m-auto m-md-0 ms-md-auto" style="max-width: 400px">
              <div class="input-group search-group">
                <input type="text" class="form-control" placeholder="Search products" aria-label="Recipient's username"
                  aria-describedby="button-addon2">
                <button class="btn" type="button" id="button-addon2">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-3 col-md-1 d-flex order-last">
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
      <div class="empty-cart text-center" data-cart-empty>
        Your Cart is Empty
      </div>
    </div>
    <div class="sidebar-cart-footer">
      <button class="btn btn-primary w-100 h-100 d-flex flex-row" data-checkout-btn>
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

    // Handle checkout button click
    document.querySelector('[data-checkout-btn]').addEventListener('click', () => {
      if(localStorage.getItem('cart') == null || localStorage.getItem('cart').length <= 0) return;

      location.href = '{{ route("orders.checkout") }}'
    })
  </script>
  @yield('pageScripts')
</body>

</html>