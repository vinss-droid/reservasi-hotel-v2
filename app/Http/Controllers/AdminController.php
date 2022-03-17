<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\FHotel;
use App\Models\FKamar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kamar()
    {

        $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->paginate(5);

        return view('Pages.Admin.Kamar', compact('kamar'));
    }

    public function saveKamar(Request $request)
    {
        $request->validate([
            'Atipe' => 'unique:kamar,tipe_kamar',
        ]);

        $rdm = Str::random(10);
        $file = $request->gambar;
        $fileName = $rdm . '_' . $request->Atipe . '.' . $file->extension();
        $file->move(public_path('/img/foto_kamar'), $fileName);

        $data = [
            'tipe_kamar' => $request->Atipe,
            'jumlah_kamar' => $request->jumlah,
            // 'kamar_aktif' => $request->jumlah,
            'foto_kamar' => $fileName,
        ];

        // dd($data);

        Kamar::create($data);

        return redirect()->route('Adminkamar')->with('berhasil', 'berhasil');
    }

    public function editKamar($id)
    {
        $kamar = Kamar::find($id);

        return response()->json([
            'data' => $kamar
        ]);
    }

    public function updateKamar(Request $request, $id)
    {
        $kamar = Kamar::find($id);

        $jumlahAktif = $kamar->jumlah_kamar - $kamar->kamar_aktif;

        $Tjumlah = $jumlahAktif + $kamar->jumlah_kamar;

        $kamarAktif = $Tjumlah + $request->Ejumlah;

        if ($request->Etipe == $kamar->tipe_kamar && $request->Egambar == NULL) {
            $data = [
                'tipe_kamar' => $request->Etipe,
                'jumlah_kamar' => $request->Ejumlah,
                // 'kamar_aktif' => $kamarAktif,
                // 'foto_kamar' => $request->Egambar,
            ];

            Kamar::find($id)->update($data);

            return redirect()->route('Adminkamar')->with('update', 'updated');
        } elseif ($request->Etipe == $kamar->tipe_kamar && $request->Egambar != NULL) {
            $data = [
                'tipe_kamar' => $request->Etipe,
                'jumlah_kamar' => $request->Ejumlah,
                // 'kamar_aktif' => $kamarAktif,
                'foto_kamar' => $request->Egambar,
            ];

            Kamar::find($id)->update($data);

            return redirect()->route('Adminkamar')->with('update', 'updated');
        } elseif ($request->Etipe != $kamar->tipe_kamar && $request->Egambar == NULL) {
            $request->validate(
                [
                    'Etipe' => 'unique:kamar,tipe_kamar'
                ],
                [
                    'Etipe.unique' => 'Tipe Kamar Sudah Ada !'
                ]
            );

            $data = [
                'tipe_kamar' => $request->Etipe,
                'jumlah_kamar' => $request->Ejumlah,
                // 'kamar_aktif' => $kamarAktif,
                // 'foto_kamar' => $request->Egambar,
            ];

            Kamar::find($id)->update($data);

            return redirect()->route('Adminkamar')->with('update', 'updated');
        } elseif ($request->Etipe != $kamar->tipe_kamar && $request->Egambar != NULL) {
            $request->validate(
                [
                    'Etipe' => 'unique:kamar,tipe_kamar'
                ],
                [
                    'Etipe.unique' => 'Tipe Kamar Sudah Ada !'
                ]
            );

            $data = [
                'tipe_kamar' => $request->Etipe,
                // 'kamar_aktif' => $kamarAktif,
                'foto_kamar' => $request->Egambar,
            ];

            Kamar::find($id)->update($data);

            return redirect()->route('Adminkamar')->with('update', 'updated');
        }
    }

    public function konfirHapus($id)
    {
        $kamar = Kamar::find($id);

        return response()->json([
            'data' => $kamar
        ]);
    }

    public function deleteKamar($id)
    {
        Kamar::find($id)->delete();

        return redirect()->route('Adminkamar')->with('hapus', 'Deleted');
    }

    public function fasilitasHotel()
    {
        $Fhotel = FHotel::orderBy('nama_fasilitas', 'ASC')->paginate(5);

        return view('Pages.Admin.FasilitasHotel', compact('Fhotel'));
    }

    public function saveFhotel(Request $request)
    {
        $request->validate(
            [
                'Afasilitas' => 'unique:fasilitas_hotel,nama_fasilitas'
            ],
            [
                'Afasilitas.unique' => 'Nama Fasilitas Sudah Ada'
            ]
        );

        $rdm = Str::random(10);
        $file = $request->gambar;
        $fileName = $rdm . '_' . $request->Afasilitas . '.' . $file->extension();
        $file->move(public_path('/img/foto_fasilitas/hotel'), $fileName);

        $data = [
            'nama_fasilitas' => $request->Afasilitas,
            'foto_fasilitas' => $fileName,
        ];

        // dd($data);

        FHotel::create($data);

        return redirect()->route('fasilitasHotel')->with('berhasil', 'SUKSES');
    }

    public function FHotel($id)
    {
        $FHotel = FHotel::find($id);

        return response()->json([
            'data' => $FHotel,
        ]);
    }

    public function deleteFHotel($id)
    {
        FHotel::find($id)->delete();

        return redirect()->route('fasilitasHotel')->with('hapus', 'Deleted');
    }

    public function updateFHotel(Request $request, $id)
    {
        $FHotel = FHotel::find($id);

        if ($FHotel->nama_fasilitas == $request->Efasilitas && $request->Egambar == NULL) {
            $data = [
                'nama_fasilitas' => $request->Efasilitas
            ];

            FHotel::find($id)->update($data);

            return redirect()->route('fasilitasHotel')->with('update', 'Edited');
        } elseif ($FHotel->nama_fasilitas == $request->Efasilitas && $request->Egambar != NULL) {
            $rdm = Str::random(10);
            $file = $request->Egambar;
            $fileName = $rdm . '_' . $request->Efasilitas . '.' . $file->extension();
            $file->move(public_path('/img/foto_fasilitas/hotel'), $fileName);

            $data = [
                'nama_fasilitas' => $request->Efasilitas,
                'foto_fasilitas' => $fileName,
            ];

            FHotel::find($id)->update($data);

            return redirect()->route('fasilitasHotel')->with('update', 'Edited');
        } elseif ($FHotel->nama_fasilitas != $request->Efasilitas && $request->Egambar == NULL) {
            $request->validate([
                'Efasilitas' => 'unique:fasilitas_hotel,nama_fasilitas',
            ]);

            $data = [
                'nama_fasilitas' => $request->Efasilitas
            ];

            FHotel::find($id)->update($data);

            return redirect()->route('fasilitasHotel')->with('update', 'Edited');
        } else {
            $request->validate([
                'Efasilitas' => 'unique:fasilitas_hotel,nama_fasilitas',
            ]);

            $rdm = Str::random(10);
            $file = $request->Egambar;
            $fileName = $rdm . '_' . $request->Efasilitas . '.' . $file->extension();
            $file->move(public_path('/img/foto_fasilitas/hotel'), $fileName);

            $data = [
                'nama_fasilitas' => $request->Efasilitas,
                'foto_fasilitas' => $fileName,
            ];

            FHotel::find($id)->update($data);

            return redirect()->route('fasilitasHotel')->with('update', 'Edited');
        }
    }

    public function fasilitasKamar()
    {
        $kamar = Kamar::orderBy('tipe_kamar', 'ASC')->get();

        $Fkamar = DB::table('fasilitas_kamar')
            ->join('kamar', 'fasilitas_kamar.id_kamar', '=', 'kamar.id')
            ->select('fasilitas_kamar.id', 'tipe_kamar', 'nama_fasilitas')
            ->orderBy('tipe_kamar', 'ASC')
            ->paginate(5);

        return view('Pages.Admin.FasilitasKamar', compact('kamar', 'Fkamar'));
    }

    public function saveFasilitasKamar(Request $request)
    {
        $CountF = FKamar::where(['id_kamar' => $request->tipe, 'nama_fasilitas' => $request->fasilitas])->count();
        // $cekF = FKamar::where('id_kamar', $request->tipe)->get();

        // dd($CountF);
        if ($CountF > 0) {
            return redirect()->route('fasilitasKamar')->with('allready', 'error');
        } else {
            $data = [
                'id_kamar' => $request->tipe,
                'nama_fasilitas' => $request->fasilitas,
            ];

            FKamar::create($data);

            return redirect()->route('fasilitasKamar')->with('berhasil', 'Added');
        }
    }

    public function findFKamar($id)
    {
        $kamar = FKamar::find($id);

        $Tkamar = Kamar::find($kamar->id_kamar);

        return response()->json([
            'fasilitas' => $kamar,
            'kamar' => $Tkamar,
        ]);
    }

    public function updateFKamar(Request $request, $id)
    {
        $CountF = FKamar::where(['id_kamar' => $request->Eid, 'nama_fasilitas' => $request->Efasilitas])->count();
        $FKamar = FKamar::find($id);

        if ($request->Efasilitas == $FKamar->nama_fasilitas) {
            $data = [
                'nama_fasilitas' => $request->Efasilitas,
            ];

            FKamar::find($id)->update($data);

            return redirect()->route('fasilitasKamar')->with('edit', 'Edited');
        } else {
            if ($CountF > 0) {
                return redirect()->route('fasilitasKamar')->with('Eallready', 'error');
            } else {
                $data = [
                    'nama_fasilitas' => $request->Efasilitas,
                ];

                FKamar::find($id)->update($data);

                return redirect()->route('fasilitasKamar')->with('update', 'Edited');
            }
        }
    }

    public function deleteFKamar($id)
    {
        FKamar::find($id)->delete();

        return redirect()->route('fasilitasKamar')->with('hapus', 'Deleted');
    }
}
