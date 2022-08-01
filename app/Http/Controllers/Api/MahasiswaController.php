<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        if ($mahasiswa->count() > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'List Data Mahasiswa',
                'data' => $mahasiswa,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Mahasiswa Kosong',
            ], 404);
        }
    }

    public function show($id)
    {
        $data = Mahasiswa::findOrFail($id);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Mahasiswa berdasarkan id ' . $id,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Mahasiswa tidak ditemukan',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $data = Mahasiswa::findOrFail($id);

        if (empty($data)) {
            return response()->json(['message' => 'data tidak ditemukan'], 404);
        }
        $data->delete();
        return response()->json([

            'message' => 'data berhasil dihapus'
        ], 200);
    }


    public function store(Request $request )
    {

        $validate = Validator::make($request->all(), [
            'nim' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);
        if ($validate->passes()) {
            $data = Mahasiswa::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Data Mahasiswa Berhasil Ditambahkan',
                'data' => $data,
            ]);

        }
        return response()->json(['message' => 'Data Gagal Disimpan']);
    }


    public function update(Request $request, $id)
    {

        $data = Mahasiswa::findOrFail($id);

        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
                'nim' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
            ]);
            if ($validate->passes()) {
                $data->update($request->all());

                return response()->json(['message' => 'Data berhasil di update',
                    'data' => $data ]);
            } else {
                return response()->json(['message' => 'data tidak ditemukan',
                    'data' => $validate->errors()->all()]);
            }
        }
        return response()->json(['message' => 'data tidak ditemukan'], 404);
    }




}
