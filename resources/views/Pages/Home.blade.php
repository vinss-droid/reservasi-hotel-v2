@extends('Layout.Bootstrap')
@section('content')

{{-- Carousel --}}

<div id="carouselExampleDark" class="carousel carousel-light slide carousel-fade ctm-carousel" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{ asset('img/Banner-Home.png') }}" class="d-block w-100 img-carousel" alt="Banner Home">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <img src="{{ asset('img/Banner-Home-2.jpg') }}" class="d-block w-100 img-carousel" alt="Banner Home 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/Banner-Home-3.jpg') }}" class="d-block w-100 img-carousel" alt="Banner Home 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

{{-- Form Pendaftaran --}}

<div class="pendaftaran bg-dark">
    <div class="container">

        @guest
            <div class="row justify-content-center mb-3">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="bg-danger py-2">
                        <p class="text-white text-center">Login terlebih dahulu untuk memesan !</p>
                        <p class="text-center"><a type="button" class="text-decoration-none fw-bold text-white"
                                id="Alogin">Login disini !</a></p>
                    </div>
                </div>
            </div>
        @endguest

        @guest
            <form action="" method="GET">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-3">
                        <label for="checkIn" class="form-label text-white">Tanggal Cek In</label>
                        <input type="date" class="form-control" id="checkIn" name="" value="{{ old('cekin') }}" @guest
                            disabled @endguest>
                        <span class="invalid-feedback" role="alert">
                            <strong>Tanggal Cek In Harus di Pilih !</strong>
                        </span>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3">
                        <label for="checkOut" class="form-label text-white">Tanggal Cek Out</label>
                        <input type="date" class="form-control" id="checkOut" value="{{ old('cekout') }}" name=""
                            placeholder="dd-mm-yyyy" @guest disabled @endguest>
                        <span class="invalid-feedback" role="alert">
                            <strong>Tanggal Cek Out Harus di Pilih !</strong>
                        </span>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3">
                        <label for="jKamar" class="form-label text-white">Jumlah Kamar</label>
                        <input type="number" class="form-control" id="jKamar" placeholder="Masukkan Jumlah Kamar" name=""
                            value="{{ old('jumlah') }}" min="0" @guest disabled @endguest>
                        <span class="invalid-feedback" role="alert">
                            <strong>Jumlah Kamar Wajib di Isi !</strong>
                        </span>
                    </div>

                    {{-- @guest --}}
                    <div class="col-sm-12 col-md-12 col-lg-1" id="pPesan">
                        <button type="submit" class="btn ctm-btn-psn @guest
                            cursor-disabled
                            @endguest " id="pesan" @guest disabled @endguest>Pesan</button>
                    </div>
                    {{-- @else --}}

                    {{-- @endguest --}}

                </div>
            </form>

        @else

            @if (Auth::user()->level == 'pemesan')
                <form action="" method="GET">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <label for="checkIn" class="form-label text-white">Tanggal Cek In</label>
                            <input type="date" class="form-control" id="checkIn" name="" value="{{ old('cekin') }}" @guest
                                disabled @endguest>
                            <span class="invalid-feedback" role="alert">
                                <strong>Tanggal Cek In Harus di Pilih !</strong>
                            </span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <label for="checkOut" class="form-label text-white">Tanggal Cek Out</label>
                            <input type="date" class="form-control" id="checkOut" value="{{ old('cekout') }}" name=""
                                placeholder="dd-mm-yyyy" @guest disabled @endguest>
                            <span class="invalid-feedback" role="alert">
                                <strong>Tanggal Cek Out Harus di Pilih !</strong>
                            </span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <label for="jKamar" class="form-label text-white">Jumlah Kamar</label>
                            <input type="number" class="form-control" id="jKamar" placeholder="Masukkan Jumlah Kamar" name=""
                                value="{{ old('jumlah') }}" min="0" @guest disabled @endguest>
                            <span class="invalid-feedback" role="alert">
                                <strong id="VCjumlah" class="text-center">Jumlah Kamar Wajib di Isi !</strong>
                            </span>
                        </div>

                        {{-- @guest --}}
                        <div class="col-sm-12 col-md-12 col-lg-1" id="pPesan">
                            <button type="submit" class="btn ctm-btn-psn @guest
                                cursor-disabled
                                @endguest " id="pesan" @guest disabled @endguest>Pesan</button>
                        </div>
                        {{-- @else --}}

                        {{-- @endguest --}}

                    </div>

                    <div class="d-none" id="Fpesan">
                        <div class="row justify-content-center">
                            <h3 class="text-white text-center fw-bold mt-5">
                                Form Pemesanan
                            </h3>
                            @csrf
                            <div class="col-sm-12 col-md-12 col-lg-4 mt-4">
                                <label for="Fpemesan" class="form-label text-white">Nama Pemesan</label>
                                <input type="text" class="form-control disabled" placeholder="Masukkan Nama Pemesan" name=""
                                    id="Fpemesan" value="{{ Auth::user()->name }}" disabled>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 mt-4">
                                <label for="Femail" class="form-label text-white">Email</label>
                                <input type="Femail" class="form-control" placeholder="Masukkan Nama Email" id="email" name=""
                                    value="{{ Auth::user()->email }}" disabled>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-4 mt-4">
                                <label for="Fnohp" class="form-label text-white">No. Handphone</label>
                                <input type="number" class="form-control disabled" placeholder="Masukkan Nomor Handphone"
                                    name="" min="0" minlength="10" maxlength="13" id="Fnohp" value="{{ Auth::user()->nohp }}"
                                    disabled>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4 mt-4">
                                <label for="Ftamu" class="form-label text-white">Nama Tamu</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Tamu" id="Ftamu" name="">
                                <span class="invalid-feedback" role="alert">
                                    <strong>Nama Tamu Harus di Isi !</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-5">
                                <label for="Fkamar" class="form-label">
                                    Tipe Kamar
                                </label>
                                <select name="Ftipe" id="Fkamar" class="form-select text-center">
                                    <option value="" selected>---- Pilih Tipe Kamar ----</option>
                                    @foreach ($kamar as $k)
                                        <option value="{{ $k->id }}">{{ $k->tipe_kamar }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong>Tipe Kamar Wajib di Pilih !</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-4">
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <div class="d-grid">
                                    <button class="btn ctm-btn-konfirm" id="Kpesan">Konfirmasi Pemesanan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @php
                    $Reservasi = DB::table('reservasi')
                                    ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
                                    ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
                                    ->where(['pemesan.email' => Auth::user()->email])
                                    ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar')
                                    ->orderBy('reservasi.created_at', 'DESC')
                                    ->limit(1)
                                    ->get();
                    $ReservasiCount = DB::table('reservasi')
                                        ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
                                        ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
                                        ->where(['pemesan.email' => Auth::user()->email])
                                        ->count();
                @endphp

                @if ($ReservasiCount > 0)
                    <div class="reservasi mt-5" id="reservasi">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-12 col-lg-10">
                                    <div class="card bg-dark shadow-lg">
                                        <div class="card-body">
                                            <div class="reservasi-title">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                                        <h3 class="text-white text-center fw-bold mt-5">
                                                            PESANAN KAMAR TERAKHIR
                                                        </h3>
                                                        <hr width="100%" class=" bg-white">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="reservasi-aksi d-inline mt-5">
                                                <center>

                                                    <a type="button" href="/bukti-reservasi-pdf/{{ Crypt::encrypt(date('d-m-Y H:i:s') , Auth::user()->name) }}" class="btn btn-success mb-5 shadow-lg d-inline">
                                                        <i class="fa-solid fa-download"></i> Download PDF
                                                    </a>

                                                    <a type="button" href="/bukti-reservasi-print/{{ Crypt::encrypt(date('d-m-Y H:i:s') , Auth::user()->name) }}" class="btn btn-warning text-white mb-5 shadow-lg d-inline" target="_BLANK">
                                                        <i class="fa-solid fa-print"></i> Print
                                                    </a>

                                                    <a type="button" href="{{ route('riwayatPesanan') }}" class="btn btn-primary text-white mb-5 shadow-lg d-inline">
                                                        <i class="fa-solid fa-clock-rotate-left"></i> Semua Riwayat Pesanan
                                                    </a>

                                                </center>
                                            </div>

                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-10">
                                                        <div class="reservasi-detail pb-5 mt-2">
                    
                                                            <div class="container">
                                                                @foreach ($Reservasi as $r)
            
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Nama Pemesan</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ $r->nama }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Email</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ $r->email }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">No.Handphone</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ $r->nohp }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Nama Tamu</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ $r->nama_tamu }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Tanggal Pemesanan</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ date('d F Y', strtotime($r->tgl_reservasi)) }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Tanggal Cek In</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ date('d F Y', strtotime($r->tgl_checkin)) }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Tanggal Cek Out</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ date('d F Y', strtotime($r->tgl_checkout)) }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Tipe Kamar</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ $r->tipe_kamar }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="row justify-content-center mt-3">
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">Jumlah Kamar</h6>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                                            <h6 class="text-left text-white">: {{ $r->jumlah_kamar }}</h6>
                                                                        </div>
                                                                    </div>
            
                                                                @endforeach
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else

                @endif 
            
            @endif

        @endguest
        
    </div>

    {{-- Tentang Kami --}}
    <div class="about ctm-mt-about">

        <div class="container">
            <h3 class="text-center text-white fw-bold">
                Tentang Kami
            </h3>

            <p class="text-justify text-white mt-5">
                Lepaskan diri Anda ke Hotel Hebat, dikelilingi oleh keindahan pegunungan yang indah, danau, dan sawah menghijau. Nikmati sore yang hangat dengan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau; Kid's Club yang luas menawarkan beragam fasilitas dan kegiatan anak-anak yang akan melengkapi kenyamanan keluarga. Convention Center kami, dilengkapi pelayanan lengkap dengan ruang konvensi terbesar di Bandung, mampu mengakomodasi hingga 3.000 delegasi. Manfaatkan ruang penyelenggaraan konvensi M.I.C.E ataupun mewujudkan acara pernikahan adat yang mewah!
            </p>

        </div>

    </div>

    @include('Layout.Footer')

</div>
@guest
{{-- Modal Login & Register --}}

<div class="modal fade" id="login" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center" id="exampleModalToggleLabel">Masuk untuk melanjutkan pemesanan
                    kamar.</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                --}}
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email')
                                is-invalid
                            @enderror" placeholder="contoh@gmail.com" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="ctm-mb-lg">
                            <label for="password" class="form-label">Password</label>

                            <div class="input-group">

                                <input type="password" class="form-control ctm-border-input @error('password')
                                    is-invalid
                                @enderror" placeholder="Masukkan Password" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" id="lgPW" name="password"
                                    value="{{ old('password') }}">

                                <span class="input-group-text ctm-group-txt" id="lgGroup"><i
                                        class="fa-solid fa-eye-slash" id="lgEye"></i></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-1">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-ctm-green">Masuk</button>

                                <button type="button" class="btn btn-secondary mt-2"
                                    data-bs-dismiss="modal">Batal</button>

                                <p class="text-center mt-2">Belum mempunyai akun? Daftar <a href="#"
                                        class="text-decoration-none" type="button" id="register">di sini.</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Register --}}

<div class="modal fade" id="mdlReg" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center" id="exampleModalToggleLabel">Daftar untuk membuat akun.</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                --}}
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="name" id="nama" class="form-control @error('name')
                                    is-invalid
                                @enderror" placeholder="Masukkan Nama" value="{{ old('name') }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email')
                                            is-invalid
                                        @enderror" placeholder="contoh@gmail.com" value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-4">
                                    <label for="hp" class="form-label">No. Handphone</label>
                                    <input type="number" name="nohp" id="hp" class="form-control @error('nohp')
                                            is-invalid
                                        @enderror" placeholder="Masukkan No.Handphone" min="0" minlength="10"
                                        maxlength="13" value="{{ old('nohp') }}">

                                    @error('nohp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>

                            <div class="input-group">

                                <input type="password" class="form-control ctm-border-input @error('password')
                                        is-invalid
                                    @enderror" placeholder="Masukkan Password" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" id="rgPW" name="password">

                                <span class="input-group-text ctm-group-txt" id="rgGroup"><i
                                        class="fa-solid fa-eye-slash" id="rgEye"></i></span>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                        </div>
                        <div class="ctm-mb-lg">
                            <label for="password" class="form-label">Konfirmasi Password</label>

                            <div class="input-group">

                                <input type="password" class="form-control ctm-border-input"
                                    placeholder="Konfirmasi Password" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" id="CrgPW" name="password_confirmation">

                                <span class="input-group-text ctm-group-txt" id="CrgGroup"><i
                                        class="fa-solid fa-eye-slash" id="CrgEye"></i></span>
                            </div>

                        </div>
                        <div class="mb-1">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-ctm-green">Daftar</button>

                                <button type="button" class="btn btn-secondary mt-2"
                                    data-bs-dismiss="modal">Batal</button>

                                <p class="text-center mt-2">Sudah mempunyai akun? Masuk <a href="#"
                                        class="text-decoration-none" id="masuk">di sini.</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endguest

@guest

@else

    {{-- Modal Konfirmasi Pesanan --}}
    <div class="modal fade" id="Cpesan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Data Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form action="" id="Freservasi"> --}}
                        @csrf
                        <div class="row justify-content-center mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label for="MtglCheckIn" class="form-label">Tanggal CheckIn</label>
                                <input type="text" name="Mcheckin" id="MtglCheckIn" class="form-control" disabled>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="mb-4">
                                    <label for="MtglCheckOut" class="form-label">Tanggal CheckOut</label>
                                    <input type="text" name="Mcheckout" id="MtglCheckOut" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <div class="mb-4">
                                    <div class="mb-4">
                                        <label for="Mjumlah" class="form-label">Jumlah Kamar</label>
                                        <input type="number" name="Mjumlah" id="Mjumlah" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <label for="Mpemesan" class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control" id="Mpemesan" value="{{ Auth::user()->name }}" disabled name="pemesan">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                <label for="Memail" class="form-label">Email Pemesan</label>
                                <input type="text" class="form-control" id="Memail" value="{{ Auth::user()->email }}" disabled name="email">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                <label for="Mnohp" class="form-label">No. Handphone</label>
                                <input type="text" class="form-control" id="Mnohp" value="{{ Auth::user()->nohp }}" disabled name="nohp">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <label for="Mtamu" class="form-label">Nama Tamu</label>
                                <input type="text" class="form-control" id="Mtamu" disabled name="tamu">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                                <label for="Mkamar" class="form-label">Tipe Kamar</label>
                                <input type="text" class="form-select" id="Mkamar" disabled>
                                <input type="text" class="form-select d-none" id="RMkamar" disabled name="kamar">
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-ctm-green" id="Mpesan">Pesan</button>
                                <button type="button" class="btn ctm-btn-psn mt-2" data-bs-dismiss="modal">Edit</button>
                            </div>
                        </div>

                    {{-- </form> --}}
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div> --}}
            </div>
        </div>
    </div>
@endguest

@endsection

@section('js')

@guest

    @if (session('empty'))

        <script>
            $(document).ready(function () {
                $('#login').modal('show');
            });
        </script>
        
    @elseif (session('shwLogin'))

        <script>
            $(document).ready(function () {
                $('#login').modal('show');
            });
        </script>

    @elseif (session('shwRegister'))

        <script>
            $(document).ready(function () {
                $('#mdlReg').modal('show');
            });
        </script>

    @elseif (session('update'))
        <script>
            Swal.fire({
                    title: 'SUKSES',
                    text: 'Berhasil mengupdate profile.',  
                    icon: 'success',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>
    @endif

    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $('#add').ready(function () {
                    $('#login').modal('show');
                });
            });
        </script>
    @endif

@else

    {{-- <script>
        $('#Fkamar').select2({
            theme: "bootstrap-5",
            width: 'resolve',
            allowClear: false,
        });
    </script> --}}


    @if ($errors->has(NULL))
        @if ($errors->any())
            <script>
                $(document).ready(function () {
                    $('#profile').ready(function () {
                        $('#mdlPro').modal('show');
                        $('#editPR').trigger('click');
                    });
                });
            </script>
        @endif
    @elseif (session('gagal'))
        <script>
            Swal.fire({
                    title: 'GAGAL',
                    text: 'Tidak bisa memesan kamar dengan nama tamu, tanggal cek in dan tanggal cek out yang sama dengan pemesanan yang belum selesai.',  
                    icon: 'error',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>
    @endif

@endguest

@endsection