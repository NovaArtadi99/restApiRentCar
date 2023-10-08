<?php

namespace App\Http\Controllers\API;

use App\Models\Penyewa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPenyewa = Penyewa::latest()->paginate(15);
        return response()->json($dataPenyewa);
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
            'no_paspor' => 'required',
            'nama_penyewa' => 'required',
            'email' => 'required',
            'password' => 'required',
            'asal_negara' => 'required',
            'jenis_kelamin' => 'required',
            'domisili' => 'required',
            'no_telepon' => 'required|numeric',
            'no_sim' => 'required|numeric'
        ]);

        try {
            // if ($request->file('gambar_mobil')) {
            //     $validateData['gambar_mobil'] = $request->file('gambar_mobil')->store('mobil-gambar_mobil');
            // }

            $penyewa = Penyewa::create($validateData);

            if ($penyewa != null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil di buat',
                    // 'data' => $penyewa
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data gagal di buat',
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
            $penyewa = Penyewa::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $penyewa
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
        {
            $validateData = $request->validate([
                'no_paspor' => 'required',
                'nama_penyewa' => 'required',
                'email' => 'required',
                'password' => 'required',
                'asal_negara' => 'required',
                'jenis_kelamin' => 'required',
                'domisili' => 'required',
                'no_telepon' => 'required|numeric',
                'no_sim' => 'required|numeric' 
            ]);
    
            try {
                $penyewa = Penyewa::findOrFail($id);
                $penyewa->update($validateData);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Penyewa berhasil di edit',
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $penyewa=Penyewa::find($id);
            $penyewa->delete();
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
