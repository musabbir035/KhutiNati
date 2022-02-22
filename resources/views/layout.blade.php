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
  <nav class="navbar navbar-expand navbar-light navbar-top">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a class="navbar-logo" href="/">
          <img src="{{ asset('img/logo.png') }}" alt="">
        </a>
        <div class="input-group">
          <input type="text" class="form-control" id="searchQuery" placeholder="Search products..."
            aria-label="Search products..." aria-describedby="searchSubmit">
          <button class="btn btn-primary shadow-none" type="button" id="searchSubmit">Search</button>
        </div>
      </div>
    </div>
  </nav>

  <nav class="navbar navbar-expand navbar-dark bg-primary navbar-main">
    <div class="container-fluid">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Categories
              <i class="fa-solid fa-chevron-down dropdown-menu-icon"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#" title="My Cart">
              <i class="fa-solid fa-cart-shopping"></i>
            </a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link"
              href="@if(in_array(auth()->user()->role, [1,2])) {{ route('admin.account') }} @else {{ route('user.account') }} @endif"
              title="My Account">
              <i class="fa-solid fa-user"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="logoutBtn" href="#" title="Log out">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logoutForm" class="d-none">
              @csrf
            </form>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" title="My Account">
              <i class="fa-solid fa-user"></i>
            </a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  @yield('main')

  <div class="footer"></div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    document.querySelector("#logoutBtn").addEventListener('click', () => {
      document.querySelector('#logoutForm').submit()
    })
  </script>
  @yield('pageScripts')
</body>

</html>