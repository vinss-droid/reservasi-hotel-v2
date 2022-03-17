<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\FHotel;
use App\Models\Pemesan;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function updateProfile(Request $request)
    {

        if (!$request->all()) {
            return redirect()->route('home')->with('empty', 'data empty');
        }

        if ($request->passwords == NULL && $request->nohp == Auth::user()->nohp && $request->name != Auth::user()->name) {

            $request->validate(
                [
                    'name' => 'required|string|max:255|unique:users,name',
                ],
                [
                    // 'name.required' => 'Nama harus di isi!',
                    'name.string' => 'Nama hanya bisa menggunakan huruf.',
                    'name.max' => 'Maksimal Nama hanya 255 huruf saja!',
                    'name.unique' => 'Nama sudah digunakan.'
                ]
            );

            $data = [
                'name' => $request->name,
            ];

            User::find(Auth::user()->id)->update($data);
            Pemesan::where('email', Auth::user()->email)->update($data);

            return redirect()->route('home')->with('update', 'updated');
        } elseif ($request->passwords == NULL && $request->nohp != Auth::user()->nohp && $request->name == Auth::user()->name) {

            $request->validate(
                [
                    // 'name' => 'required|string|max:255|unique:users,name',
                    'nohp' => 'required|min:10|max:13|unique:users,nohp',
                    // 'passwords' => 'required|string|min:6|confirmed',
                ],
                [
                    'nohp.required' => 'No.Handphone wajib di isi!',
                    'nohp.min' => 'Minimal No.Handphone 10 digit!',
                    'nohp.max' => 'Minimal No.Handphone 13 digit!',
                    'nohp.unique' => 'No.Handphone sudah digunakan.'
                ]
            );

            $data = [
                // 'name' => $request->name,
                'nohp' => $request->nohp,
                // 'password' => Hash::make($request->passwords)
            ];

            User::find(Auth::user()->id)->update($data);
            Pemesan::where('email', Auth::user()->email)->update($data);

            return redirect()->route('home')->with('update', 'updated');
        } elseif ($request->passwords == NULL && $request->nohp != Auth::user()->nohp && $request->name != Auth::user()->name) {

            $request->validate(
                [
                    'name' => 'required|string|max:255|unique:users,name',
                    'nohp' => 'required|min:10|max:13|unique:users,nohp',
                    // 'passwords' => 'required|string|min:6|confirmed',
                ],
                [
                    'name.required' => 'Nama harus di isi!',
                    // 'name.string' => 'Nama hanya bisa menggunakan huruf!',
                    'name.max' => 'Maksimal Nama hanya 255 huruf saja!',
                    'name.unique' => 'Nama sudah digunakan !',
                    'nohp.required' => 'No.Handphone wajib di isi!',
                    'nohp.min' => 'Minimal No.Handphone 10 digit!',
                    'nohp.max' => 'Minimal No.Handphone 13 digit!',
                    'nohp.unique' => 'No.Handphone sudah digunakan.'
                ]
            );

            $data = [
                'name' => $request->name,
                'nohp' => $request->nohp,
                // 'password' => Hash::make($request->passwords)
            ];

            User::find(Auth::user()->id)->update($data);
            Pemesan::where('email', Auth::user()->email)->update($data);

            return redirect()->route('home')->with('update', 'updated');
        } elseif ($request->passwords == NULL && $request->nohp == Auth::user()->nohp && $request->name == Auth::user()->name) {

            return redirect()->route('home')->with('update', 'updated');
        } else {

            $request->validate(
                [
                    'name' => 'required|string|max:255|unique:users,name',
                    'nohp' => 'required|min:10|max:13|unique:users,nohp',
                    'passwords' => 'required|string|min:6|confirmed',
                ],
                [
                    'name.required' => 'Nama harus di isi!',
                    // 'name.string' => 'Nama hanya bisa menggunakan huruf!',
                    'name.max' => 'Maksimal Nama hanya 255 huruf saja!',
                    'name.unique' => 'Nama sudah digunakan !',
                    'nohp.required' => 'No.Handphone wajib di isi!',
                    'nohp.min' => 'Minimal No.Handphone 10 digit!',
                    'nohp.max' => 'Minimal No.Handphone 13 digit!',
                    'nohp.unique' => 'No.Handphone sudah digunakan.',
                    'passwords.required' => 'Password wajib di isi!',
                    // 'passwords.string' => 'Password hanya bisa menggunakan huruf'
                    'passwords.min' => 'Minimal password 6 digit!',
                    'passwords.confirmed' => 'Konfirmasi Password Salah!'
                ]
            );

            $data = [
                'name' => $request->name,
                'nohp' => $request->nohp,
                'password' => Hash::make($request->passwords)
            ];

            User::find(Auth::user()->id)->update($data);
            Pemesan::where('email', Auth::user()->email)->update($data);

            return redirect()->route('home')->with('update', 'updated');
        }
    }

    public function index()
    {
        // if (!Auth::check()) {

        //     $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        //     // $dateNow = date('d-m-Y');

        //     // $idPemesan = Pemesan::where('email', Auth::user()->email)->get();

        //     // foreach ($idPemesan as $id) {
        //     //     $idP = $id->id;
        //     // }

        //     // $ReservasiCount = Reservasi::orderBy('created_at', 'DESC')->where('id_pemesan', $idP)->count();

        //     return view('Pages.Home', compact('kamar'));
        // } else {

        //     if (Auth::user()->level == 'pemesan') {
        //         $idPemesan = Pemesan::where('email', Auth::user()->email)->get();

        //         foreach ($idPemesan as $id) {
        //             $idP = $id->id;
        //         }

        //         $ReservasiCount = Reservasi::orderBy('created_at', 'DESC')->where('id_pemesan', $idP)->limit(1)->count();

        //         $Reservasi = Reservasi::orderBy('created_at', 'DESC')->where('id_pemesan', $idP)->limit(1)->get();

        //         foreach ($Reservasi as $r) {
        //             $Cselesai = $r->selesai;
        //         }

        //         // dd($ReservasiCount > 0 && $Cselesai == 0);

        //         if ($ReservasiCount > 0 && $Cselesai == 0) {
        //             $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        //             $dateNow = date('d-m-Y');

        //             $idPemesan = Pemesan::where('email', Auth::user()->email)->get();

        //             foreach ($idPemesan as $id) {
        //                 $idP = $id->id;
        //             }

        //             $Reservasi = Reservasi::orderBy('created_at', 'DESC')->where('id_pemesan', $idP)->limit(1)->get();
        //             $ReservasiCount = Reservasi::orderBy('created_at', 'DESC')->where('id_pemesan', $idP)->limit(1)->count();

        //             foreach ($Reservasi as $val) {
        //                 $UserCheckout = $val->tgl_checkout;
        //                 $idPReservasi = $val->id_pemesan;
        //                 $idKamar = $val->id_kamar;
        //             }

        //             $Pemesan = Pemesan::where('id', $idPReservasi)->get();

        //             $Kamar = Kamar::where('id', $idKamar)->select('tipe_kamar')->get();

        //             return view('Pages.Home', compact('kamar', 'UserCheckout', 'dateNow', 'Reservasi', 'Pemesan', 'Kamar', 'ReservasiCount'));
        //         } else {
        //             $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        //             return view('Pages.Home', compact('kamar'));
        //         }
        //     } else {
        //         $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        //         return view('Pages.Home', compact('kamar'));
        //     }
        // }

        $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        return view('Pages.Home', compact('kamar'));

    }

    public function cekJKamar($id)
    {
        $kamar = Kamar::find($id);

        $JKreservasi = Reservasi::where(['id_kamar' => $id, 'selesai' => '0'])->sum('jumlah_kamar');

        $JKtersedia = $kamar->jumlah_kamar - $JKreservasi;

        return response()->json([
            'data' => $JKtersedia
        ]);
    }

    public function kamar()
    {
        $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        return view('Pages.Kamar', compact('kamar'));
    }

    public function fasilitas()
    {
        $Fhotel = FHotel::orderBy('nama_fasilitas', 'ASC')->get();

        return view('Pages.Fasilitas', compact('Fhotel'));
    }

    public function riwayatPesanan()
    {
        $riwayat = DB::table('reservasi')
            ->join('pemesan', 'reservasi.id_pemesan', '=', 'pemesan.id')
            ->join('kamar', 'reservasi.id_kamar', '=', 'kamar.id')
            ->where('pemesan.email', Auth::user()->email)
            ->select('reservasi.*', 'pemesan.nama', 'pemesan.nohp', 'pemesan.email', 'kamar.tipe_kamar', 'kamar.jumlah_kamar')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('Pages.RiwayatPesanan', compact('riwayat'));
    }
}
