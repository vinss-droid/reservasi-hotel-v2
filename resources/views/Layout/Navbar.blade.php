<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-lg">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">HOTEL HEBAT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page"
            href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('kamar') ? 'active' : '' }}" href="{{ route('kamar') }}">Kamar</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('fasilitas') }}"
            class="nav-link {{ Request::is('fasilitas') ? 'active' : '' }}">Fasilitas</a>
        </li>
        @guest
        <li class="nav-item">
          <a type="button" class="nav-link" id="nav-log"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-center" aria-labelledby="navbarDropdown">
            @if (Auth::user()->level == 'admin')
            <li><a class="dropdown-item" href="{{ route('Adminkamar') }}" id="" type="button"><i class="fa-solid fa-gauge-high"></i> Dashboard</a></li>
            @elseif (Auth::user()->level == 'resepsionis')
            <li><a class="dropdown-item" href="{{ route('Rreservasi') }}" id="" type="button"><i class="fa-solid fa-gauge-high"></i> Dashboard</a></li>
            @endif
            <li><a class="dropdown-item" href="" id="profile" type="button"><i class="fa-solid fa-id-card"></i> Profile</a></li>
            @if (Auth::user()->level == 'pemesan')
              <li><a class="dropdown-item" href="{{ route('riwayatPesanan') }}" id="" type="button"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat</a></li>
            @endif
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
          </ul>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>