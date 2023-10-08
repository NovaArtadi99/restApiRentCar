<?php

namespace App\Http\Controllers\API;

use App\Models\Transaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTransaksi = Transaksi::latest()->paginate(15);
        return response()->json($dataTransaksi);
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
            'kode_transaksi' => 'required',
            'plat_mobil' => 'required',
            'no_paspor' => 'required',
            'id_pegawai' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'total' => 'required',
            'km_awal' => 'required',
            'km_akhir' => 'required',
            'catatan' => 'required',
            'status_transaksi' => 'required'
        ]);

        try {
            // if ($request->file('gambar_mobil')) {
            //     $validateData['gambar_mobil'] = $request->file('gambar_mobil')->store('mobil-gambar_mobil');
            // }

            $transaksi = Transaksi::create($validateData);

            if ($transaksi != null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Transaksi berhasil di buat',
                    // 'data' => $transaksi
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi gagal di buat',
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
    public function show(string $id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $transaksi
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
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'kode_transaksi' => 'required',
            'plat_mobil' => 'required',
            'no_paspor' => 'required',
            'id_pegawai' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'total' => 'required',
            'km_awal' => 'required',
            'km_akhir' => 'required',
            'catatan' => 'required',
            'status_transaksi' => 'required'
        ]);

        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update($validateData);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil di edit',
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
    public function destroy(string $id)
    {
        try {
            $transaksi=Transaksi::find($id);
            $transaksi->delete();
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
    }
}
