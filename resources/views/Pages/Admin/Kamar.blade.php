@extends('Pages.Admin.layouts.Bootstrap')

@if (Auth::user()->level == 'admin')
    @section('title', '| Admin')
@else
    @section('title', '| Resepsionis')
@endif

@section('content')

<div class="bg-dark ctm-mt-nav">
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center text-white pb-3 ctm-pt-akamar">Data Kamar</h5>
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
                            <table class="table table-hover table-bordered text-white text-center shadow-lg" width="100%" cellspacing="0" id="TKamar">
                                <thead>
                                    <tr>
                                        <th class="col-3">Tipe Kamar</th>
                                        <th class="col-3">Jumlah Kamar</th>
                                        @if (Auth::user()->level == 'admin')
                                            <th class="col-3">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                @foreach ($kamar as $k)
                                <tbody class="hover-dark">
                                    <tr class="hover-dark">
                                        <td class="hover-dark col-3">{{ $k->tipe_kamar }}</td>
                                        <td class="hover-dark col-3">{{ $k->jumlah_kamar }}</td>
                                        @if (Auth::user()->level == 'admin')
                                            <td class="col-3">
                                                <a type="button" class="btn btn-warning btn-sm d-inline" id="edit" data-id="{{ $k->id }}">Ubah</a>
                                                <a type="button" class="btn btn-danger btn-sm d-inline" id="hapus"
                                                    data-id="{{ $k->id }}" id="hapus">Hapus</a>
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{ $kamar->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('saveKamar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe Kamar</label>
                            <input type="text" class="form-control" placeholder="Masukkan Tipe Kamar" id="tipe"
                                name="Atipe">
                            <span class="invalid-feedback" role="alert">
                                <strong>Tipe Kamar Wajib di Isi !</strong>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Kamar</label>
                            <input type="number" class="form-control" placeholder="Masukkan Jumlah Kamar" id="jumlah"
                                name="jumlah">
                            <span class="invalid-feedback" role="alert">
                                <strong>Jumlah Kamar Wajib di Isi !</strong>
                            </span>
                        </div>
                        <div class="mb-4">
                            <label for="img" class="form-label">Foto Kamar</label>
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
                            <label for="tipe" class="form-label">Tipe Kamar</label>
                            <input type="text" class="form-control" placeholder="Masukkan Tipe Kamar" id="Etipe"
                                name="Etipe">
                            <span class="invalid-feedback" role="alert">
                                <strong>Tipe Kamar Wajib di Isi !</strong>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Kamar</label>
                            <input type="number" class="form-control" placeholder="Masukkan Jumlah Kamar" id="Ejumlah"
                                name="Ejumlah">
                            <span class="invalid-feedback" role="alert">
                                <strong>Jumlah Kamar Wajib di Isi !</strong>
                            </span>
                        </div>
                        <div class="mb-4">
                            <label for="img" class="form-label">Foto Kamar</label>
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

@if (Auth::user()->level == 'admin')
    @section('js')

    @if (session('berhasil'))
        <script>
            Swal.fire({
                    title: 'SUKSES',
                    text: 'Berhasil menambahkan data kamar.',  
                    icon: 'success',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>

    @elseif (session('hapus'))
    <script>
        Swal.fire({
                title: 'SUKSES',
                text: 'Berhasil menghapus data kamar.',  
                icon: 'success',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif (session('update'))
    <script>
        Swal.fire({
                title: 'SUKSES',
                text: 'Berhasil mengupdate data kamar.',  
                icon: 'success',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif ($errors->has('Etipe'))
    <script>
        Swal.fire({
                title: 'GAGAL UPDATE',
                text: 'Tipe Kamar Sudah Ada.',  
                icon: 'error',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif ($errors->has('Atipe'))
    <script>
        Swal.fire({
                title: 'GAGAL MENAMBAHKAN DATA',
                text: 'Tipe Kamar Sudah Ada.',  
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

                    $.get('/admin/konfirmasi-hapus-kamar/' + id, function (data) {            
                        $('#Mhapus').modal('show');
                        $('#Mtitle').text('Hapus Data Kamar ' + data.data.tipe_kamar)
                        $('#Tconfirm').html('Silahkan ketik <span class="badge bg-secondary fw-normal">hapus-kamar-' + data.data.tipe_kamar + '</span> untuk mengkonfirmasi penghapusan data kamar.');
                        $('#FBconfirm').text('Hapus Kamar ' + data.data.tipe_kamar);
                        $('#MFhapus').attr('action', '/admin/delete-kamar/' + data.data.id);


                        $('#FBconfirm').click(function (e) { 
                            e.preventDefault();
                            if ($('#Fconfirm').val() == 'hapus-kamar-' + data.data.tipe_kamar) {
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

                    $.get('/admin/edit-kamar/' + id, function (data) {            
                        $('#Medit').modal('show');
                        $('#EMtitle').text('Edit Data Kamar ' + data.data.tipe_kamar)
                        $('#Etipe').val(data.data.tipe_kamar);
                        $('#Ejumlah').val(data.data.jumlah_kamar);
                        

                        $('#AEsimpan').click(function (e) {
                            e.preventDefault();
                            if ($('#Etipe').val() && $('#Ejumlah').val() != '') {
                                $('#Etipe').removeClass('is-invalid');
                                $('#Ejumlah').removeClass('is-invalid');
                                $('#Fedit').attr('action', '/admin/update-kamar/' + data.data.id);
                                $('#Esubmit').trigger('click');
                            } else if ($('#Etipe').val() == '') {
                                $('#Etipe').addClass('is-invalid');
                                // $('#Ejumlah').removeClass('is-invalid');
                            } else if ($('#Ejumlah').val() == '') {
                                $('#Ejumlah').addClass('is-invalid');
                                // $('#Etipe').removeClass('is-invalid');
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

                $('#tipe').keyup(function (e) {

                    if ($(this).val() != '') {

                        $('#tipe').removeClass('is-invalid');
                        $('#jumlah').removeClass('is-invalid');

                        $('#jumlah').keyup(function (e) { 
                            if ($(this).val() != '') {
                                $('#Asimpan').removeAttr('disabled');
                                $('#tipe').removeClass('is-invalid');
                                $('#jumlah').removeClass('is-invalid');
                            } else {
                                $('#Asimpan').attr('disabled', true);
                                // $('#tipe').addClass('is-invalid');
                                $('#jumlah').addClass('is-invalid');
                            }
                        });

                    } else {
                        $('#Asimpan').attr('disabled', true)
                        $('#tipe').addClass('is-invalid');
                        // $('#jumlah').addClass('is-invalid');
                    }
                });
            } );
            
    </script>
    @endsection
@else
    
@endif
