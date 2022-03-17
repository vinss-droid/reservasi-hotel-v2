@extends('Layout.Bootstrap')
@section('title', ' | Riwayat Pesanan')
@section('content')
    <div class="bg-dark mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <h1 class="text-center text-white pb-3 ctm-pt-akamar">Riwayat Pemesanan</h5>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card shadow-lg bg-dark">
                    <div class="card-body">
                        <div class="row justify-content-center mt-4">
                            <div class="table-responsive">
                                {{-- <div class="row justify-content-between">
                                    <div class="col-sm-12 col-md-12 col-lg-3 bg-danger">
                                        <form action="{{ route('RdateFilter') }}" method="post">
                                            @csrf
                                            <label for="dateFilter" class="form-label text-white">Filter Data Cek In</label>
                                            <div class="input-group">
                                                <input type="date" name="dateFilter" class="form-control" id="dateFilter">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}
                                <table class="table table-hover table-bordered text-white text-center shadow-lg"
                                    id="dataTable" width="100%" cellspacing="0" id="Tkamar">
                                    <thead>
                                        <tr>

                                            <th class="col-1">No</th>
                                            <th class="col-2">Nama Tamu</th>
                                            <th class="col-1">Tanggal Pemesanan</th>
                                            <th class="col-1">Tanggal Chek In</th>
                                            <th class="col-1">Tanggal Chek Out</th>
                                            <th class="col-1">Tipe Kamar</th>
                                            <th class="col-1">Status</th>
                                            <th class="col-1">Aksi</th>
                                            
                                        </tr>
                                    </thead>

                                    @php
                                        $no = 1;
                                        $dateNow = date('d-m-Y');
                                    @endphp

                                    @foreach ($riwayat as $r)

                                        <tbody class="hover-dark">
                                            <tr class="hover-dark">
                                                <td class="hover-dark col-1">{{ $no++ }}</td>
                                                <td class="hover-dark col-2">{{ $r->nama_tamu }}</td>
                                                <td class="hover-dark col-1">{{ date('d F Y', strtotime($r->tgl_reservasi)) }}</td>
                                                <td class="hover-dark col-1">{{ date('d F Y', strtotime($r->tgl_checkin)) }}</td>
                                                <td class="hover-dark col-1">{{ date('d F Y', strtotime($r->tgl_checkout)) }}</td>
                                                <td class="hover-dark col-1">{{ $r->tipe_kamar }}</td>
                                                <td class="hover-dark col-1">
                                                    @if ($dateNow >= $r->tgl_reservasi && $dateNow < $r->tgl_checkin)
                                                        <span class="badge rounded-pill bg-warning fw-normal">Booking</span>
                                                    @elseif($dateNow > $r->tgl_checkin && $dateNow < $r->tgl_checkout)
                                                        <span class="badge rounded-pill bg-info fw-normal">Cek In</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-success fw-normal">Selesai</span>
                                                    @endif
                                                </td>
                                                <td class="hover-dark col-2">
                                                    <form action="/riwayat-pesanan/download-pdf/{{ Crypt::encrypt($r->id) }}/{{ Crypt::encrypt(date('d-m-Y H:i:s') , Auth::user()->name) }}" method="POST" class="d-inline shadow-lg">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm text-white shadow-lg">
                                                            <i class="fa-solid fa-download"></i> Download PDF
                                                        </button>
                                                    </form>
                                                    {{-- <form action="/riwayat-pesanan/print/{{ Crypt::encrypt($r->id) }}/{{ Crypt::encrypt(date('d-m-Y H:i:s') , Auth::user()->name) }}" method="post" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning btn-sm text-white" target="_BLANK">
                                                            <i class="fa-solid fa-print"></i> Print
                                                        </button>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        </tbody>

                                    @endforeach
                                </table>
                                {{ $riwayat->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        @include('Pages.Admin.layouts.Footer')
    </div>
@endsection