<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerkuliahanController extends Controller
{
    public function index()
    {
        $perkuliahan = Perkuliahan::all();

        if ($perkuliahan->count() > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'List Data Perkuliahan',
                'data' => $perkuliahan,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Perkuliahan Kosong',
            ], 404);
        }
    }

    public function show($id)
    {
        $data = Perkuliahan::findOrFail($id);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Perkuliahan berdasarkan id ' . $id,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Perkuliahan tidak ditemukan',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $data = Perkuliahan::findOrFail($id);

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
            'nim' => 'required',
            'kode_mk' => 'required',
            'nip' => 'required',
            'nilai' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $perkuliahan = Perkuliahan::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data Perkuliahan berhasil ditambahkan',
            'data' => $perkuliahan,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'kode_mk' => 'required',
            'nip' => 'required',
            'nilai' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $perkuliahan = Perkuliahan::findOrFail($id);
        $perkuliahan->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data Perkuliahan berhasil diubah',
            'data' => $perkuliahan,
        ], 200);
    }

}
