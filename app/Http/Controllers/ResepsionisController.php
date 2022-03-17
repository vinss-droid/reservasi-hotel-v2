<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\FHotel;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepsionisController extends Controller
{
    public function index()
    {
        $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->paginate(5);

        return view('Pages.Admin.Kamar', compact('kamar'));
    }

    public function fasilKamar()
    {
        $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        $Fkamar = DB::table('fasilitas_kamar')
                    ->join('kamar', 'fasilitas_kamar.id_kamar', '=', 'kamar.id')
                    ->select('fasilitas_kamar.id','tipe_kamar','nama_fasilitas')
                    ->orderBy('tipe_kamar', 'ASC')
                    ->paginate(5);

        return view('Pages.Admin.FasilitasKamar', compact('kamar','Fkamar'));
    }

    public function fasilHotel()
    {
        $Fhotel = FHotel::orderBy('nama_fasilitas', 'ASC')->paginate(5);

        return view('Pages.Admin.FasilitasHotel', compact('Fhotel'));
    }

    public function reservasi()
    {
        $reservasi = DB::table('reservasi')
                    ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
                    ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
                    // ->where('selesai', '0')
                    ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar', 'kamar.jumlah_kamar')
                    ->orderBy('reservasi.id', 'ASC')
                    ->paginate(5);

        return view('Pages.Resepsionis.Reservasi', compact('reservasi'));
    }
    
    public function dateFilter(Request $request)
    {

        $date = date('d-m-Y', strtotime($request->dateFilter));

        if ($request->dateFilter == NULL) {
            session()->forget('searchTamu');
            session()->forget('dateFilter');
            return redirect()->route('Rreservasi');
        } else {
            session()->forget('searchTamu');
            $result = DB::table('reservasi')
                    ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
                    ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
                    ->where('reservasi.tgl_checkin', $date)
                    ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar', 'kamar.jumlah_kamar')
                    ->orderBy('reservasi.id', 'ASC')
                    ->get();

            // dd($result);

            session()->put('dateFilter', $result);

            return redirect()->route('Rreservasi');
        }
    }

    public function searchTamu(Request $request)
    {
        // dd($request->searchTamu);
        if ($request->searchTamu == NULL) {
            session()->forget('dateFilter');
            session()->forget('searchTamu');
            return redirect()->route('Rreservasi');
        } else {
            session()->forget('dateFilter');
            $result = DB::table('reservasi')
                    ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
                    ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
                    ->where('reservasi.nama_tamu', 'LIKE', '%'.$request->searchTamu.'%')
                    ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar', 'kamar.jumlah_kamar')
                    ->orderBy('reservasi.id', 'ASC')
                    ->get();

            // dd($result);

            session()->put('searchTamu', $result);

            $STamu = session()->get('searchTamu');

            // dd($STamu);

            return redirect()->route('Rreservasi');
        }
    }

    public function Dreservasi($id)
    {
        $reservasi = Reservasi::find($id);

        return response()->json([
            'data' => $reservasi,
        ]);
    }

    public function Ureservasi(Request $request, $id)
    {
        $data = [
            'selesai' => '1'
        ];

        Reservasi::find($id)->update($data);

        return redirect()->route('Rreservasi')->with('update', 'Updated');
    }
}
