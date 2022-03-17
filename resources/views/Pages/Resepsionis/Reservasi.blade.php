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
            <h1 class="text-center text-white pb-3 ctm-pt-akamar">Data Reservasi Hotel</h5>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card shadow-lg bg-dark">
                <div class="card-body">
                    <div class="row justify-content-center mt-4">
                        <div class="table-responsive">
                            <div class="row justify-content-between">
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <form action="{{ route('RdateFilter') }}" method="post">
                                        @csrf
                                        <label for="dateFilter" class="form-label text-white">Filter Data Cek In</label>
                                        <div class="input-group mb-3">
                                            <input type="date" name="dateFilter" class="form-control" id="dateFilter">
                                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <form action="{{ route('searchTamu') }}" method="post">
                                        @csrf
                                        <label for="searchTamu" class="form-label text-white">Cari Nama Tamu</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="searchTamu" class="form-control" id="searchTamu" placeholder="Nama Tamu">
                                            <button type="submit" class="btn btn-primary btn-sm" id="searchTamu">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-hover table-bordered text-white text-center shadow-lg"
                                id="dataTable" width="100%" cellspacing="0" id="Tkamar">
                                <thead>
                                    <tr>
                                        <th class="col-3">Nama Tamu</th>
                                        <th class="col-3">Tanggal Cek In</th>
                                        <th class="col-3">Tanggal Cek Out</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-2">Aksi</th>
                                        
                                    </tr>
                                </thead>

                                @if (session()->has('dateFilter'))
                                    @php
                                        $dateNow = date('d-m-Y');
                                        $filter = session()->get('dateFilter');
                                        foreach ($filter as $f) {
                                            $tglCekIn = $f->tgl_checkin;
                                        }
                                    @endphp
                                @else 
                                    @php
                                        $dateNow = date('d-m-Y');
                                    @endphp
                                @endif

                                @if (session()->has('dateFilter'))
                                    <h5 class="text-center text-white mb-3">Hasil Data Dari Tanggal Cek In <a type="button" class="text-decoration-none cursor-text">{{ date('d F Y', strtotime($tglCekIn)) }}</a></h5>
                                @endif
                                
                                @if (session()->has('dateFilter') == NULL && session()->has('searchTamu') == NULL)
                                    @foreach ($reservasi as $r)

                                        <tbody class="hover-dark">
                                            <tr class="hover-dark">
                                                <td class="hover-dark col-3">{{ $r->nama_tamu }}</td>
                                                <td class="hover-dark col-3">{{ date('d F Y', strtotime($r->tgl_checkin)) }}</td>
                                                <td class="hover-dark col-3">{{ date('d F Y', strtotime($r->tgl_checkout)) }}</td>
                                                <td class="hover-dark col-2">
                                                    @if ($dateNow < $r->tgl_checkin)
                                                        Booking
                                                    @elseif($dateNow >= $r->tgl_checkin && $dateNow < $r->tgl_checkout)
                                                        Cek In
                                                    @else
                                                        Cek Out
                                                    @endif
                                                </td>
                                                @if ($dateNow > $r->tgl_checkin && $dateNow >= $r->tgl_checkout && $r->selesai == 0)
                                                    <td class="hover-dark col-2">
                                                        <button class="btn btn-success btn-sm text-white" id="selesai" data-id="{{ $r->id }}">
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @elseif ($dateNow > $r->tgl_checkin && $dateNow >= $r->tgl_checkout && $r->selesai == 1)
                                                    <td>
                                                        <button class="btn btn-success btn-sm text-white" disabled>
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" disabled>
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    @endforeach

                                @elseif (session()->has('dateFilter'))
                                    {{-- {{ session()->get('dateFilter') }} --}}
                                    
                                    @php
                                        $filter = session()->get('dateFilter');
                                    @endphp

                                    @foreach ($filter as $f)

                                        <tbody class="hover-dark">
                                            <tr class="hover-dark">
                                                <td class="hover-dark col-3">{{ $f->nama_tamu }}</td>
                                                <td class="hover-dark col-3">{{ date('d F Y', strtotime($f->tgl_checkin)) }}</td>
                                                <td class="hover-dark col-3">{{ date('d F Y', strtotime($f->tgl_checkout)) }}</td>
                                                <td class="hover-dark col-2">
                                                    @if ($dateNow >= $f->tgl_reservasi && $dateNow < $f->tgl_checkin)
                                                        <span class="badge rounded-pill bg-warning fw-normal">Booking</span>
                                                    @elseif($dateNow > $f->tgl_checkin && $dateNow < $f->tgl_checkout)
                                                        <span class="badge rounded-pill bg-info text-white fw-normal">Cek In</span>
                                                    @elseif ($f->selesai == 1)
                                                        <span class="badge rounded-pill bg-success fw-normal">Selesai</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger fw-normal">Cek Out</span>
                                                    @endif
                                                </td>
                                                @if ($dateNow > $f->tgl_checkin && $dateNow >= $f->tgl_checkout && $f->selesai == 0)
                                                    <td class="hover-dark col-2">
                                                        <button class="btn btn-success btn-sm" id="selesai" data-id="{{ $f->id }}">
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @elseif ($dateNow > $f->tgl_checkin && $dateNow >= $f->tgl_checkout && $f->selesai == 1)
                                                    <td>
                                                        <button class="btn btn-success btn-sm text-white" disabled>
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" disabled>
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    @endforeach

                                @elseif (session()->has('searchTamu'))
                                
                                    @php
                                        $search = session()->get('searchTamu');
                                    @endphp

                                    @foreach ($search as $s)

                                        <tbody class="hover-dark">
                                            <tr class="hover-dark">
                                                <td class="hover-dark col-3">{{ $s->nama_tamu }}</td>
                                                <td class="hover-dark col-3">{{ date('d F Y', strtotime($s->tgl_checkin)) }}</td>
                                                <td class="hover-dark col-3">{{ date('d F Y', strtotime($s->tgl_checkout)) }}</td>
                                                <td class="hover-dark col-2">
                                                    @if ($dateNow >= $s->tgl_reservasi && $dateNow < $s->tgl_checkin)
                                                        <span class="badge rounded-pill bg-warning fw-normal">Booking</span>
                                                    @elseif($dateNow > $s->tgl_checkin && $dateNow < $s->tgl_checkout)
                                                        <span class="badge rounded-pill bg-info text-white fw-normal">Cek In</span>
                                                    @elseif ($s->selesai == 1)
                                                        <span class="badge rounded-pill bg-success text-white fw-normal">Selesai</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger fw-normal">Cek Out</span>
                                                    @endif
                                                </td>
                                                @if ($dateNow > $s->tgl_checkin && $dateNow >= $s->tgl_checkout && $s->selesai == 0)
                                                    <td class="hover-dark col-2">
                                                        <button class="btn btn-success btn-sm" id="selesai" data-id="{{ $s->id }}">
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @elseif ($dateNow > $s->tgl_checkin && $dateNow >= $s->tgl_checkout && $s->selesai == 1)
                                                    <td>
                                                        <button class="btn btn-success btn-sm text-white" disabled>
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" disabled>
                                                            Selesai
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>

                                    @endforeach

                                @endif

                            </table>
                            {{ $reservasi->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Pages.Admin.layouts.Footer')
</div>

{{-- Modal Selesai --}}

<div class="modal fade" id="Mselesai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Mtitle"></h5>
                <button type="button" class="btn-close" aria-label="Close" id="Fclose" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- <h5 class="mb-4 fw-normal text-center">Konfirmasi Se</h5> --}}

                <form method="POST" id="MFselesai">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="Fconfirm" class="form-label" id="Tconfirm"></label>
                        <input type="text" class="form-control" id="Fconfirm">
                        <span class="invalid-feedback" role="alert">
                            <strong id="Calert"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <div class="d-grid">
                            <button class="btn btn-danger" id="MBRconfirm"></button>
                            <button type="submit" id="MBRCsubmit" class="d-none"></button>
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

@endsection

@section('js')

    @if (session('update'))
        <script>
            Swal.fire({
                    title: 'SUKSES',
                    text: 'Berhasil Menyelesaikan Reservasi',  
                    icon: 'success',  
                    confirmButtonText: 'OKE',
                    theme: 'dark'
                })
        </script>
    @endif

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // SELESAI
            $('#selesai').click(function (e) { 
                const id = $(this).data('id');

                e.preventDefault();
                $.get('/resepsionis/selesai-pemesanan/' + id, function (data) {   

                    $('#Mselesai').modal('show')
                    $('#Mtitle').text('Konfirmasi Selesai Tamu ' + data.data.nama_tamu);
                    $('#Tconfirm').html('Silahkan ketik <span class="badge bg-secondary fw-normal">selesai-pesanan-tamu-' + data.data.nama_tamu + '</span> untuk mengkonfirmasi penyelesaian pesanan tamu.');
                    $('#MBRconfirm').text('Selesai Pesanan Tamu ' + data.data.nama_tamu);
                    $('#MFselesai').attr('action', '/resepsionis/selesai-pemesanan/' + data.data.id);

                    $('#MBRconfirm').click(function (e) { 
                        e.preventDefault();
                        if ($('#Fconfirm').val() == 'selesai-pesanan-tamu-' + data.data.nama_tamu) {
                            $('#MBRCsubmit').trigger('click');
                        } else if ($('#Fconfirm').val() == ''){
                            $('#Calert').text('Konfirmasi Penyelesaian Wajib di Isi !');
                            $('#Fconfirm').addClass('is-invalid');
                        } else {
                            $('#Calert').text('Konfirmasi Penyelesaian Harus Benar !');
                            $('#Fconfirm').addClass('is-invalid');
                        }
                    });

                });
            });

        });
    </script>
@endsection