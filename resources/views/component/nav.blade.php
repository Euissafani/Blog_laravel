<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #E0144C">
    <div class="container">
      <a class="navbar-brand" href="#">ESF Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ ($active == "home") ?'active':'' }}" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active == "about") ?'active':'' }}" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active == "posts") ?'active':'' }}" href="/posts">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active == "categories") ?'active':'' }}" href="/categories">Categories</a>
          </li>
        </ul>
{{-- di bawah di gunakan agar user yg sudah login list navbar loginnya ilang di ganti dengan dropdown --}}
        <ul class="navbar-nav ms-auto">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{-- {{ auth()->user()->name }} di gunakan untuk mengambil nama user --}}
              Welcome back,{{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dahboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                {{-- untuk logout harus di buat form | dropdown-itrm di gunakan agara tidak bersifat button --}}
                <form action="/logout" method="post">
                  @csrf
                   <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout </button>
                </form>
              </li>
            </ul>
          </li>     
          @else
            <li class="nav-item">
              <a href="/login" class="nav-link"> <i class="bi bi-box-arrow-in-left"></i>Login</a>
            </li>
          @endauth
        </ul>    
     {{--End--}}
      </div>
    </div>
  </nav>