@extends('Layout.Bootstrap')
@section('title', '| Fasilitas')
@section('content')

{{-- Carousel --}}

<div id="carouselExampleDark" class="carousel carousel-light slide carousel-fade ctm-carousel carousel-kamar"
    data-bs-ride="carousel">
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


<div class="bg-dark pt-5">
    <div class="container">
        <div class="row justify-content-center" id="Vimg">
            @foreach ($Fhotel as $f)
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="card h-100 shadow-lg bg-cdf" style="background-color: rgb(54, 54, 54)">
                        <div class="card-body">
                            <img src="{{ asset('img/foto_fasilitas/hotel/') . '/' . $f->foto_fasilitas }}" alt="Fasilitas Hotel" width="100%" class="h-60 cursor-pointer">
                            <hr>
                            <h4 class="card-title text-center text-white">{{ $f->nama_fasilitas }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                    aria-describedby="basic-addon2" id="CrgPW" name="passwords_confirmation">

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

@endsection

@section('js')

    <script>
        const viewer = new Viewer(document.getElementById('Vimg'), {
            inline: false,
            button: true,
            keyboard: false,
            moveable: false,
            navbar: false,
            rotataable: false,
            scalable: false,
            slideOnTouch: false,
            title: false,
            toogleOnDblclick: false,
            toolbar: false,
            tooltip: false,
            zoomable: false,
            zoomOnTouch: false,
            zoomOnWheel: false,
            viewed() {
                viewer.zoomTo(1);
            },
        })
    </script>

    <script src="{{ asset('js/main.js') }}"></script>

        @guest

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
            @endif

        @endguest

    @endsection