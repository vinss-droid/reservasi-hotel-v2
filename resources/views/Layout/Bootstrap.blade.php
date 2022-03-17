<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Hebat @yield('title')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500&display=swap" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- Logo --}}
    <link rel="shortcut icon" href="{{ asset('img/logo/oyo.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo/oyo.ico') }}">

    {{-- Viewer JS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.min.css">

    {{-- SelectTwo --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

    {{-- SweetAlert --}}
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>
<body>

    @include('Layout.Navbar')
    
    @yield('content')

    @guest

    @else
        {{-- Modal Profile --}}

        <div class="modal fade" id="mdlPro" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalToggleLabel">Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="PRclose"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-3 ms-auto d-block">
                                <button class="btn btn-warning btn-sm d-block" id="ubahPR">
                                    <i class="fa-solid fa-pen-to-square"></i> Ubah
                                </button>
                                <button class="btn btn-danger btn-sm d-block d-none" id="batalPR">
                                    <i class="fa-solid fa-xmark"></i> Batal
                                </button>
                            </div>
                            <form action="{{ route('updateProfile') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="PRnama" class="form-label">Nama</label>
                                    <input type="text" name="name" id="PRnama" class="form-control @error('name')
                                    is-invalid
                                @enderror" placeholder="Masukkan Nama" value="{{ Auth::user()->name }}" disabled>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6" id="PRCemail">
                                        <div class="mb-4">
                                            <label for="PRemail" class="form-label">Email</label>
                                            <input type="email" name="emails" id="PRemail" class="form-control @error('emails')
                                            is-invalid
                                        @enderror" placeholder="contoh@gmail.com" value="{{ Auth::user()->email }}" disabled>

                                            @error('emails')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6" id="PRChp">
                                        <div class="mb-4">
                                            <label for="PRhp" class="form-label">No. Handphone</label>
                                            <input type="number" name="nohp" id="PRhp" class="form-control @error('nohp')
                                            is-invalid
                                        @enderror" placeholder="Masukkan No.Handphone" min="0" minlength="10"
                                                maxlength="13" value="{{ Auth::user()->nohp }}" disabled>

                                            @error('nohp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 d-none" id="PRCpw">
                                    <label for="password" class="form-label">Password</label>

                                    <div class="input-group">

                                        <input type="password" class="form-control ctm-border-input @error('passwords')
                                        is-invalid
                                    @enderror" placeholder="Masukkan Password" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" id="prPW" name="passwords">

                                        <span class="input-group-text ctm-group-txt" id="prGroup"><i
                                                class="fa-solid fa-eye-slash" id="prEye"></i></span>

                                        @error('passwords')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                </div>

                                <div class="ctm-mb-lg d-none" id="cPW">
                                    <label for="password" class="form-label">Konfirmasi Password</label>

                                    <div class="input-group">

                                        <input type="password" class="form-control ctm-border-input"
                                            placeholder="Konfirmasi Password" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" id="CprPW" name="passwords_confirmation">

                                        <span class="input-group-text ctm-group-txt" id="CprGroup"><i
                                                class="fa-solid fa-eye-slash" id="CprGroup"></i></span>
                                    </div>

                                </div>

                                <div class="mb-1">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-ctm-green" id="btnSimpan" disabled>Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

{{-- Jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- FontAwesome --}}
<script src="https://kit.fontawesome.com/768e0ea7cb.js" crossorigin="anonymous"></script>

{{-- Viewer JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.min.js"></script>

{{-- SelectTwo --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- SweetAlert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- My JS --}}
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/validation.js') }}"></script>
<script src="{{ asset('js/RealTimeInput.js') }}"></script>

@if (session('EPRerror'))
    <script>
        $(document).ready(function () {
            $('#ubahPR').trigger('click');
            $('#mdlPro').modal('show');
        });
    </script>
@elseif (session('update'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                    title: 'SUKSES',
                    text: 'Berhasil Meng-update Profile.',  
                    icon: 'success',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        });
    </script>
@endif

@yield('js')

</body>
</html>