<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();

        if ($dosen->count() > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'List Data Dosen',
                'data' => $dosen,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Dosen Kosong',
            ], 404);
        }
    }

    public function show($id)
    {
        $data = Dosen::findOrFail($id);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Dosen berdasarkan id ' . $id,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Dosen tidak ditemukan',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $data = Dosen::findOrFail($id);

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
            'nip' => 'required|unique:dosens',
            'nama_dosen' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }
        $dosen = Dosen::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data Dosen berhasil ditambahkan',
            'data' => $dosen,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:dosens,nip,' . $id,
            'nama_dosen' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }
        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data Dosen berhasil diubah',
            'data' => $dosen,
        ], 200);
    }
}
