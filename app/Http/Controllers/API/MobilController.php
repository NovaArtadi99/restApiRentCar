<?php

namespace App\Http\Controllers\API;
use App\Models\Mobil;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMobil = Mobil::latest()->paginate(15);
        return response()->json($dataMobil);
        $mobil = Mobil::where('plat_mobil', 2)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'plat_mobil' => 'required',
            'nama_mobil' => 'required',
            'warna' => 'required',
            'tipe' => 'required',
            // 'tahun' => 'required',
            'tahun' => 'required|numeric', //nomer
            // 'tgl_pajak' => 'required',
            'tgl_pajak' => 'required|date', // tgl
            'nama_pemilik' => 'required',
            'cc' => 'required|numeric',
            'harga_sewa' => 'required|numeric',
            'status' => 'required',
            'gambar_mobil' => 'required',
            'tgl_catat' => 'required|date'
        ]);

        try {
            // $fileName = time().$request->file('gambar_mobil')->getClientOriginalName();
            // $path = $request->file('gambar_mobil')->storeAs('uploads/mobil',$fileName);
            // $validateData['gambar_mobil']=$path;
            if ($request->file('gambar_mobil')) {
                $validateData['gambar_mobil'] = $request->file('gambar_mobil')->store('mobil-gambar_mobil');
            }

            $mobil = Mobil::create($validateData);

            if ($mobil != null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gambar berhasil di buat',
                    // 'data' => $mobil
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gambar gagal di buat',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Err',
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $plat_mobil)
    {
        try {
            $mobil = Mobil::findOrFail($plat_mobil);

            return response()->json([
                'success' => true,
                'data' => $mobil
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $plat_mobil)
    {
        $validateData = $request->validate([
            'plat_mobil' => 'required',
            'nama_mobil' => 'required',
            'warna' => 'required',
            'tipe' => 'required',
            'tahun' => 'required',
            'tgl_pajak' => 'required',
            'nama_pemilik' => 'required',
            'cc' => 'required',
            'harga_sewa' => 'required',
            'status' => 'required',
            'gambar_mobil' => '',
            'tgl_catat' => 'required'
        ]);

        try {
            $mobil = Mobil::findOrFail($plat_mobil);

            if ($request->hasFile('gambar_mobil')) {
                // Hapus gambar lama jika ada
                if ($mobil->gambar_mobil) {
                    Storage::delete($mobil->gambar_mobil);
                }
                // Simpan gambar baru
                $validateData['gambar_mobil'] = $request->file('gambar_mobil')->store('mobil-gambar_mobil');
            }

            $mobil->update($validateData);

            return response()->json([
                'success' => true,
                'message' => 'Mobil berhasil di edit',
                // 'data' => $mobil
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $plat_mobil)
    {
        try {
            $mobil=Mobil::find($plat_mobil);
            $mobil->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
            ]);
        }
        // try {
        //     $mobil = Mobil::findOrFail($plat_mobil);

        //     // Hapus gambar terkait jika ada
        //     if ($mobil->gambar_mobil) {
        //         Storage::delete($mobil->gambar_mobil);
        //     }

        //     $mobil->delete();

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Mobil berhasil dihapus'
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => 'Error',
        //         'errors' => $e->getMessage()
        //     ]);
        // }
    }
}
