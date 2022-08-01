<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mata_kuliah = Matakuliah::all();

        if ($mata_kuliah->count() > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'List Data Mata Kuliah',
                'data' => $mata_kuliah,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Mata Kuliah Kosong',
            ], 404);
        }
    }

    public function show($id)
    {
        $data = MataKuliah::findOrFail($id);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Mata Kuliah berdasarkan id ' . $id,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Mata Kuliah tidak ditemukan',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $data = MataKuliah::findOrFail($id);

        if (empty($data)) {
            return response()->json(['message' => 'data tidak ditemukan'], 404);
        }
        $data->delete();
        return response()->json([

            'message' => 'data berhasil dihapus'
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $mata_kuliah = Matakuliah::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data Mata Kuliah berhasil ditambahkan',
            'data' => $mata_kuliah,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        $mata_kuliah = Matakuliah::findOrFail($id);
        $mata_kuliah->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data Mata Kuliah berhasil diubah',
            'data' => $mata_kuliah,
        ], 200);
    }


}
