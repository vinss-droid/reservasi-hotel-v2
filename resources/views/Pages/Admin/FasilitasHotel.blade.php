@extends('Pages.Admin.layouts.Bootstrap')
@section('title', '| Admin')
@section('content')

<div class="bg-dark ctm-mt-nav">
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center text-white pb-3 ctm-pt-akamar">Data Fasilitas Hotel</h5>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card shadow-lg bg-dark">
                <div class="card-body">
                    <div class="row justify-content-center mt-4">
                        <div class="table-responsive">
                            @if (Auth::user()->level == 'admin')
                                <button class="btn ctm-btn-primary mb-3" id="add">
                                    <i class="fa-solid fa-plus"></i> Tambah
                                </button>
                            @endif
                            <table class="table table-hover table-bordered text-white text-center shadow-lg"
                                width="100%" cellspacing="0" id="Tkamar">
                                <thead>
                                    <tr>
                                        <th class="col-3">Nama Fasilitas</th>
                                        <th class="col-3">Foto Fasilitas</th>
                                        @if (Auth::user()->level == 'admin')
                                            <th class="col-3">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                @foreach ($Fhotel as $h)
                                <tbody class="hover-dark">
                                    <tr class="hover-dark">
                                        <td class="hover-dark col-3">{{ ucwords($h->nama_fasilitas) }}</td>
                                        <td class="hover-dark col-3">
                                            <img src="{{ asset('img/foto_fasilitas/hotel') . '/' . $h->foto_fasilitas }}"
                                                alt="{{ $h->foto_fasilitas }}" width="50%" class="cursor-pointer">
                                        </td>
                                        @if (Auth::user()->level == 'admin')
                                            <td class="col-3">
                                                <a type="button" class="btn btn-warning btn-sm d-inline" id="edit"
                                                    data-id="{{ $h->id }}">Ubah</a>
                                                <a type="button" class="btn btn-danger btn-sm d-inline" id="hapus"
                                                    data-id="{{ $h->id }}" id="hapus">Hapus</a>
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{ $Fhotel->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL TAMBAH DATA --}}
    <div class="modal fade" id="Madd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Fasilitas Hotel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('saveFhotel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="fasilitas" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Fasilitas" id="fasilitas"
                                name="Afasilitas">
                            <span class="invalid-feedback" role="alert">
                                <strong>Nama Fasilitas Wajib di Isi !</strong>
                            </span>
                        </div>
                        <div class="mb-4">
                            <label for="img" class="form-label">Foto Fasilitas</label>
                            <input type="file" class="form-control" id="img" accept=".png, .jpg, .jpeg" required
                                name="gambar">
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-ctm-green" id="Asimpan" disabled>
                                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT DATA --}}
    <div class="modal fade" id="Medit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EMtitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="Fedit">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Fasilitas"
                                id="Efasilitas" name="Efasilitas">
                            <span class="invalid-feedback" role="alert">
                                <strong>Nama Fasilitas Wajib di Isi !</strong>
                            </span>
                        </div>
                        <div class="mb-4">
                            <label for="img" class="form-label">Gambar Fasilitas</label>
                            <input type="file" class="form-control" id="Eimg" accept=".png, .jpg, .jpeg" name="Egambar">
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-ctm-green" id="AEsimpan">
                                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                                </button>
                                <button class="d-none" type="submit" id="Esubmit"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="Mhapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Mtitle"></h5>
                    <button type="button" class="btn-close" aria-label="Close" id="Fclose"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-4 fw-normal text-center">Data yang dihapus tidak dapat di kembalikan lagi.</h5>

                    <form method="POST" id="MFhapus">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="Fconfirm" class="form-label" id="Tconfirm"></label>
                            <input type="text" class="form-control" id="Fconfirm">
                            <span class="invalid-feedback" role="alert">
                                <strong id="Calert"></strong>
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-danger" id="FBconfirm"></button>
                                <button type="submit" id="FBCsubmit" class="d-none"></button>
                                <button type="reset" class="d-none" id="reset"></button>
                            </div>
                        </div>
                    </form>

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div> --}}
            </div>
        </div>
    </div>


    @include('Pages.Admin.layouts.Footer')
</div>

@endsection

@section('js')
    <script>
        const viewer = new Viewer(document.getElementById('Tkamar'), {
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
    @if (Auth::user()->level == 'admin')

        @if (session('berhasil'))
        <script>
            Swal.fire({
                        title: 'SUKSES',
                        text: 'Berhasil menambahkan data fasilitas hotel.',  
                        icon: 'success',  
                        confirmButtonText: 'OKE',
                        theme: 'dark'
                    })
        </script>

        @elseif (session('hapus'))
        <script>
            Swal.fire({
                    title: 'SUKSES',
                    text: 'Berhasil menghapus data fasilitas hotel.',  
                    icon: 'success',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>

        @elseif (session('update'))
        <script>
            Swal.fire({
                    title: 'SUKSES',
                    text: 'Berhasil mengupdate data fasilitas hotel.',  
                    icon: 'success',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>

        @elseif ($errors->has('Efasilitas'))
        <script>
            Swal.fire({
                    title: 'GAGAL UPDATE',
                    text: 'Fasilitas Hotel Sudah Ada.',  
                    icon: 'error',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>

        @elseif ($errors->has('Afasilitas'))
        <script>
            Swal.fire({
                    title: 'GAGAL MENAMBAHKAN DATA',
                    text: 'Fasilitas Hotel Sudah Ada.',  
                    icon: 'error',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>
        @endif 

        <script>
            $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // DELETE

                    $('body').on('click', '#hapus', function (e) { 
                        e.preventDefault();
                        const id = $(this).data('id');
                        // console.log(id)

                        $.get('/admin/find-fasilitas-hotel/' + id, function (data) {            
                            $('#Mhapus').modal('show');
                            $('#Mtitle').text('Hapus Fasilitas Hotel ' + '"' + data.data.nama_fasilitas + '"')
                            $('#Tconfirm').html('Silahkan ketik <span class="badge bg-secondary fw-normal">hapus-fasilitas-hotel-' + data.data.nama_fasilitas + '</span> untuk mengkonfirmasi penghapusan data fasilitas hotel.');
                            $('#FBconfirm').text('Hapus Fasilitas Hotel ' + data.data.nama_fasilitas);
                            $('#MFhapus').attr('action', '/admin/delete-fasilitas-hotel/' + data.data.id);


                            $('#FBconfirm').click(function (e) { 
                                e.preventDefault();
                                if ($('#Fconfirm').val() == 'hapus-fasilitas-hotel-' + data.data.nama_fasilitas) {
                                    $('#FBCsubmit').trigger('click');
                                } else if ($('#Fconfirm').val() == ''){
                                    $('#Calert').text('Konfirmasi Penghapusan Wajib di Isi !');
                                    $('#Fconfirm').addClass('is-invalid');
                                } else {
                                    $('#Calert').text('Konfirmasi Penghapusan Harus Benar !');
                                    $('#Fconfirm').addClass('is-invalid');
                                }
                            });

                        });

                    });


                    // UPDATE
                    $('body').on('click', '#edit', function (e) {
                        e.preventDefault();
                        const id = $(this).data('id');
                        // console.log(id)

                        $.get('/admin/find-fasilitas-hotel/' + id, function (data) {            
                            $('#Medit').modal('show');
                            $('#EMtitle').text('Edit Data Fasilitas Hotel ' + '"' + data.data.nama_fasilitas + '"');
                            $('#Efasilitas').val(data.data.nama_fasilitas);
                            

                            $('#AEsimpan').click(function (e) {
                                e.preventDefault();
                                if ($('#Efasilitas').val() && $('#Ejumlah').val() != '') {
                                    $('#Efasilitas').removeClass('is-invalid');
                                    $('#Fedit').attr('action', '/admin/update-fasilitas-hotel/' + data.data.id);
                                    $('#Esubmit').trigger('click');
                                } else if ($('#Efasilitas').val() == '') {
                                    $('#Efasilitas').addClass('is-invalid');
                                } else {
                                    $('#Etipe').addClass('is-invalid');
                                    $('#Ejumlah').addClass('is-invalid');
                                }
                            });

                        });
                    });


                    $('#Fclose').click(function (e) {
                        e.preventDefault();
                        $('#reset').trigger('click');
                        $('#Mhapus').modal('hide');
                    });

                    $('#add').click(function (e) { 
                        e.preventDefault();
                        $('#Madd').modal('show');
                    });

                    // ADD

                    $('#fasilitas').keyup(function (e) {

                        if ($(this).val() != '') {

                            $('#tipe').removeClass('is-invalid');
                            $('#jumlah').removeClass('is-invalid');
                            $('#Asimpan').removeAttr('disabled');
                        } else {
                            $('#Asimpan').attr('disabled', true)
                            $('#tipe').addClass('is-invalid');
                            // $('#jumlah').addClass('is-invalid');
                        }
                    });
                } );
                
        </script>
    @endif
@endsection
