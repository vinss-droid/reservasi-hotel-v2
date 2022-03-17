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
            <h1 class="text-center text-white pb-3 ctm-pt-akamar">Data Fasilitas Kamar</h5>
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
                                id="dataTable" width="100%" cellspacing="0" id="Tkamar">
                                <thead>
                                    <tr>
                                        <th class="col-3">Tipe Kamar</th>
                                        <th class="col-3">Nama Fasilitas</th>
                                        @if (Auth::user()->level == 'admin')
                                            <th class="col-3">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                @foreach ($Fkamar as $k)
                                <tbody class="hover-dark">
                                    <tr class="hover-dark">
                                        <td class="hover-dark col-3">{{ ucwords($k->tipe_kamar) }}</td>
                                        <td class="hover-dark col-3" id="Vimg">
                                            {{ ucwords($k->nama_fasilitas) }}
                                        </td>
                                        @if (Auth::user()->level == 'admin')
                                            <td class="col-3">
                                                <a type="button" class="btn btn-warning btn-sm d-inline" id="edit"
                                                    data-id="{{ $k->id }}">Ubah</a>
                                                <a type="button" class="btn btn-danger btn-sm d-inline" id="hapus"
                                                    data-id="{{ $k->id }}" id="hapus">Hapus</a>
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{ $Fkamar->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Fasilitas Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('saveFasilitasKamar') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Atipe" class="form-label">Tipe Kamar</label>
                            <select name="tipe" class="form-select text-center" id="Atipe" required>
                                <option value="" selected>----- Pilih Tipe Kamar -----</option>
                                @foreach ($kamar as $k)
                                    <option value="{{ $k->id }}">{{ $k->tipe_kamar }}</option>
                                @endforeach
                            </select>
                            {{-- <span class="invalid-feedback" role="alert">
                                <strong>Nama Fasilitas Wajib di Isi !</strong>
                            </span> --}}
                        </div>
                        <div class="mb-4">
                            <label for="fasilitas" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Masukkan Nama Fasilitas" required>
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
                    <h5 class="modal-title text-center" id="EMtitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="Fedit">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="tipe" class="form-label">Nama Fasilitas</label>
                            <input type="hidden" name="Eid" id="Eid">
                            <input type="text" class="form-control" placeholder="Masukkan Nama Fasilitas"
                                id="Efasilitas" name="Efasilitas">
                            <span class="invalid-feedback" role="alert">
                                <strong>Nama Fasilitas Wajib di Isi !</strong>
                            </span>
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
                    <h5 class="modal-title text-center" id="Mtitle"></h5>
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

    {{-- <script>
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
    </script> --}}

    @if (session('berhasil'))
    <script>
        Swal.fire({
                    title: 'SUKSES',
                    text: 'Berhasil menambahkan data fasilitas kamar.',  
                    icon: 'success',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
    </script>

    @elseif (session('hapus'))
    <script>
        Swal.fire({
                title: 'SUKSES',
                text: 'Berhasil menghapus data fasilitas kamar.',  
                icon: 'success',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif (session('update'))
    <script>
        Swal.fire({
                title: 'SUKSES',
                text: 'Berhasil mengupdate data fasilitas kamar.',  
                icon: 'success',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif (session('edit'))
    <script>
        Swal.fire({
                title: 'TIDAK ADA PERUBAHAN',
                text: 'Tidak ada perubahan data fasilitas kamar.',  
                icon: 'info',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif ($errors->has('Efasilitas'))
    <script>
        Swal.fire({
                title: 'GAGAL UPDATE',
                text: 'Fasilitas Kamar Sudah Ada.',  
                icon: 'error',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif ($errors->has('Afasilitas'))
    <script>
        Swal.fire({
                title: 'GAGAL MENAMBAHKAN DATA',
                text: 'Fasilitas Kamar Sudah Ada.',  
                icon: 'error',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif (session('allready'))
    <script>
        Swal.fire({
                title: 'GAGAL MENAMBAHKAN DATA',
                text: 'Fasilitas Kamar Sudah Ada.',  
                icon: 'error',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @elseif (session('Eallready'))
    <script>
        Swal.fire({
                title: 'GAGAL UPDATE DATA',
                text: 'Fasilitas Kamar Sudah Ada.',  
                icon: 'error',  
                confirmButtonText: 'OKE',
                theme: 'dark'
            })
    </script>

    @endif 

    <script>
        $(document).ready(function() {

                // SelectTwo Kamar
                $('#Atipe').select2({
                    theme: "bootstrap-5",
                    width: 'resolve',
                    dropdownParent: $('#Madd'),
                    allowClear: false,
                });
                
                // $('#Etipe').select2({
                //     theme: "bootstrap-5",
                //     width: 'resolve',
                //     dropdownParent: $('#Medit'),
                //     allowClear: false,
                // });

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

                    $.get('/admin/find-fasilitas-kamar/' + id, function (data) {            
                        $('#Mhapus').modal('show');
                        $('#Mtitle').text('Hapus Fasilitas Kamar ' + '"' + data.fasilitas.nama_fasilitas + '" dari kamar ' + data.kamar.tipe_kamar)
                        $('#Tconfirm').html('Silahkan ketik <span class="badge bg-secondary fw-normal">hapus-fasilitas-kamar-' + data.fasilitas.nama_fasilitas + '</span> untuk mengkonfirmasi penghapusan data fasilitas kamar.');
                        $('#FBconfirm').text('Hapus Fasilitas Kamar ' + data.fasilitas.nama_fasilitas);
                        $('#MFhapus').attr('action', '/admin/delete-fasilitas-kamar/' + data.fasilitas.id);


                        $('#FBconfirm').click(function (e) { 
                            e.preventDefault();
                            if ($('#Fconfirm').val() == 'hapus-fasilitas-kamar-' + data.fasilitas.nama_fasilitas) {
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

                    $.get('/admin/find-fasilitas-kamar/' + id, function (data) {            
                        $('#Medit').modal('show');
                        $('#EMtitle').text('Edit Data Fasilitas Kamar ' + '"' + data.fasilitas.nama_fasilitas + '" dari kamar ' + data.kamar.tipe_kamar);
                        $('#Efasilitas').val(data.fasilitas.nama_fasilitas);
                        $('#Eid').val(data.kamar.id);
                        // $('#EOtipe').text(data.kamar.tipe_kamar);
                        // $('#EOtipe').trigger('change');
                        // console.log($('#Eid').val())



                        $('#AEsimpan').click(function (e) {
                            e.preventDefault();
                            if ($('#Efasilitas').val() && $('#Ejumlah').val() != '') {
                                $('#Efasilitas').removeClass('is-invalid');
                                $('#Fedit').attr('action', '/admin/update-fasilitas-kamar/' + data.fasilitas.id);
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
    @endsection
@endif