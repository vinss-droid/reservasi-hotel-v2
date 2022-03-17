<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use PDF;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Crypt;

class ReservasiController extends Controller
{
    public function indexAdd(Request $request)
    {

        $idPemesan = Pemesan::where('email', $request->email)->get();

        $tglReservasi = date('d-m-Y');
        $tglCheckIn = date('d-m-Y', strtotime($request->checkin));
        $tglCheckOut = date('d-m-Y', strtotime($request->checkout));
        $namaTamu = ucwords($request->tamu);

        $cekNamaTamu = Reservasi::where(['nama_tamu' => $namaTamu, 'tgl_checkin' => $tglCheckIn, 'tgl_checkout' => $tglCheckOut, 'selesai' => 0])->count();

        // dd($cekNamaTamu);

        if ($cekNamaTamu == 0) {
            foreach ($idPemesan as $p) {
                $idP = $p->id;
            }
    
            $data = [
                'id_pemesan' => $idP,
                'id_kamar' => $request->kamar,
                'tgl_reservasi' => $tglReservasi,
                'tgl_checkin' => $tglCheckIn,
                'tgl_checkout' => $tglCheckOut,
                'nama_tamu' => $namaTamu,
                'jumlah_kamar' => $request->jumlah,
                'selesai' => '0',
            ];
    
            Reservasi::create($data);
    
            return response()->json(200);
        } else {
            // return redirect()->route('home')->with('gagal', 'Gagal');
            return response()->json(230);
        }
        
        
    }

    public function ReservasiPDF()
    {
        $reservasi = DB::table('reservasi')
            ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
            ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
            ->where(['pemesan.email' => Auth::user()->email])
            ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar')
            ->orderBy('reservasi.created_at', 'DESC')
            ->limit(1)
            ->first();

        // dd($reservasi);

        $path = base_path('\public\img\logo\oyo.png');
        $data = base64_encode(file_get_contents($path));
        $logo = 'data:' . mime_content_type($path) . ';base64,' . $data;
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pages.PDF.BuktiReservasi', compact('reservasi', 'logo'));

        return $pdf->download('Bukti Reservasi ' . $reservasi->nama_tamu . ' ' . $reservasi->tgl_reservasi . '.pdf');
    }

    public function ReservasiPrint()
    {
        $reservasi = DB::table('reservasi')
            ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
            ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
            ->where(['pemesan.email' => Auth::user()->email])
            ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar')
            ->orderBy('reservasi.created_at', 'DESC')
            ->limit(1)
            ->first();

        // dd($reservasi);

        // view()->share('reservasi', $reservasi);
        $path = base_path('\public\img\logo\oyo.png');
        $data = base64_encode(file_get_contents($path));
        $logo = 'data:' . mime_content_type($path) . ';base64,' . $data;
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pages.PDF.BuktiReservasi', compact('reservasi', 'logo'));

        return $pdf->stream();
    }

    public function RiwayatPDF($id)
    {
        $ID = Crypt::decrypt($id);

        $reservasi = DB::table('reservasi')
            ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
            ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
            ->where(['pemesan.email' => Auth::user()->email, 'reservasi.id' => $ID])
            ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar')
            ->limit(1)
            ->first();

            $path = base_path('\public\img\logo\oyo.png');
            $data = base64_encode(file_get_contents($path));
            $logo = 'data:' . mime_content_type($path) . ';base64,' . $data;
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pages.PDF.BuktiReservasi', compact('reservasi', 'logo'));

            return $pdf->download('Bukti Reservasi ' . $reservasi->nama_tamu . ' ' . $reservasi->tgl_reservasi . '.pdf');
    }
    
    public function RiwayatPDFPrint($id)
    {
        $ID = Crypt::decrypt($id);

        $reservasi = DB::table('reservasi')
            ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
            ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
            ->where(['pemesan.email' => Auth::user()->email, 'reservasi.id' => $ID])
            ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar')
            ->limit(1)
            ->first();

            $path = base_path('\public\img\logo\oyo.png');
            $data = base64_encode(file_get_contents($path));
            $logo = 'data:' . mime_content_type($path) . ';base64,' . $data;
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pages.PDF.BuktiReservasi', compact('reservasi', 'logo'));

            return $pdf->stream();
    }
}
