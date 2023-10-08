<?php

namespace App\Http\Controllers\API;

use App\Models\Pegawai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPegawai = Pegawai::latest()->paginate(5);
        return response()->json($dataPegawai);
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
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        try {
            // if ($request->file('gambar_mobil')) {
            //     $validateData['gambar_mobil'] = $request->file('gambar_mobil')->store('mobil-gambar_mobil');
            // }

            $pegawai = Pegawai::create($validateData);

            if ($pegawai != null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil di buat',
                    // 'data' => $pegawai
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
    public function show(string $id_pegawai)
    {
        try {
            $pegawai = Pegawai::findOrFail($id_pegawai);

            return response()->json([
                'success' => true,
                'data' => $pegawai
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
    public function update(Request $request, string $id_pegawai)
    {
        $validateData = $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required' 
        ]);

        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->update($validateData);

            return response()->json([
                'success' => true,
                'message' => 'Pegawai berhasil di edit',
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
            $pegawai=Pegawai::find($id);
            $pegawai->delete();
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
