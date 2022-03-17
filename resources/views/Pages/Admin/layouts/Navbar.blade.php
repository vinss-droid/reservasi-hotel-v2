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
          {{-- <a class="nav-link {{ Request::is('kamar') ? 'active' : '' }}" aria-current="page"
            href="{{ route('home') }}">Admin</a> --}}
          <h5 class="nav-link active user-select-none">{{ ucwords(Auth::user()->level) }}</h5>
        </li>
        @if (Auth::user()->level == 'resepsionis')
          <li class="nav-item">
            <a class="nav-link {{ Request::is('resepsionis') ? 'active' : '' }}" href="{{ route('Rreservasi') }}">Reservasi</a>
          </li>
        @endif
        <li class="nav-item">
          @if (Auth::user()->level == 'admin')
            <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('Adminkamar') }}">Kamar</a>
          @else
            <a class="nav-link {{ Request::is('resepsionis/kamar') ? 'active' : '' }}" href="{{ route('resepsionis') }}">Kamar</a>
          @endif
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Fasilitas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-center" aria-labelledby="navbarDropdown">
            @if (Auth::user()->level == 'admin')
              <li><a class="dropdown-item {{ Request::is('admin/fasilitas-kamar') ? 'active' : '' }}" href="{{ route('fasilitasKamar') }}">Kamar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item {{ Request::is('admin/fasilitas-hotel') ? 'active' : '' }}" href="{{ route('fasilitasHotel') }}">Hotel</a></li>
            @else
              <li><a class="dropdown-item {{ Request::is('resepsionis/fasilitas-kamar') ? 'active' : '' }}" href="{{ route('RfasilKamar') }}">Kamar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item {{ Request::is('resepsionis/fasilitas-hotel') ? 'active' : '' }}" href="{{ route('RfasilHotel') }}">Hotel</a></li>
            @endif
          </ul>
        </li>
        @guest
        <li class="nav-item">
          <a type="button" class="nav-link" id="nav-log"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-center" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('home') }}">Home</a></li>
            <li><a class="dropdown-item" href="" id="profile" type="button">Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
          </ul>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>