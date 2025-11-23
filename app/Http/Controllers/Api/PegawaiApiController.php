<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $pegawai = Pegawai::all();

    return response()->json([
        'message' => 'Data pegawai berhasil diambil',
        'data' => $pegawai
    ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    try{
       $data = $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'email' => 'required|email|unique:pegawais,email',
    ]);

    $pegawai = Pegawai::create($data);
    if(!$pegawai){
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Gagal menambahkan pegawai'
            ], 500);
        }
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Pegawai berhasil ditambahkan',
                'data' => $pegawai
            ], 201);
        } catch (\Exception $e) {
            // 4. INTERNAL SERVER ERROR (500)
            return response()->json([
                'success' => false,
                'status'  => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error'   => $e->getMessage()
            ], 500);
    }
    // return response()->json(['received' => $request->all()], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return response()->json([
            'success' => true,
            'status' => 200,
            'data' => $pegawai
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'jabatan' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:pegawais,email,' . $id,
    ]);
        $pegawai = Pegawai::find($id);
        if(!$pegawai){
        return response()->json([
            'success' => false,
            'status'=> 404,
            'message'=>'Pegawai tidak ditemukan'
        ], 404);
      }
        $pegawai->update($validated);
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Pegawai berhasil diupdate',
            'data' => $pegawai, 
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::find($id);
        if(!$pegawai){
            return response()->json([
                'success' => false,
                'status'=> 404,
                'message' => 'Pegawai tidak ditemukan'
            ], 404);
        }

        $pegawai->delete();
            return response()->json([
                'success'=> true,
                'status' => 200,
                'message'=> 'Data berhasil dihapus'
            ], 200);   
    }
}
