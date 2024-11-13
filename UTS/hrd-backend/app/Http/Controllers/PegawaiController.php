<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    // Fungsi untuk menampilkan semua data
    public function index()
    {
        // Melihat Data
        $pegawai = Pegawai::all(); // Menggunakan Eloquent
        if ($pegawai) {
            $data = [
                'message' => 'Get All Resource',
                'data' => $pegawai
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
            ];
            return response()->json($data, 200);
        }
    }

    // Fungsi untuk menyimpan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'email' => 'email|required',
            'status' => 'required',
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }
        $pegawai = Pegawai::create($request->all());
        $data = [
            'message' => 'Resource is added successfully',
            'data' => $pegawai
        ];
        return response()->json($data, 201);
    }

    // Get Detai Data
    public function show($id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $pegawai
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];
            return response()->json($data, 404);
        }
    }

    // Fungsi untuk mengubah data berdasarkan id
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            $pegawai->name = $request->name ?? $pegawai->name;
            $pegawai->gender = $request->gender ?? $pegawai->gender;
            $pegawai->phone = $request->phone ?? $pegawai->phone;
            $pegawai->address = $request->address ?? $pegawai->address;
            $pegawai->email = $request->email ?? $pegawai->email;
            $pegawai->status = $request->status ?? $pegawai->status;
            $pegawai->date = $request->date ?? $pegawai->date;
            $pegawai->save();
            $data = [
                'message' => 'Resource is updated successfully',
                'data' => $pegawai
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];
            return response()->json($data, 404);
        }
    }

    // Fungsi untuk menghapus data berdasarkan id
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            $pegawai->delete();
            $data = [
                'message' => 'Resource is delete successfully',
                'data' => $pegawai
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];
            return response()->json($data, 404);
        }
    }

    // fungsi untuk mencari
    public function search($name)
    {
        $pegawai = Pegawai::where($name);
        if ($pegawai) {
            $data = [
                'message' => 'Get Searched Resource',
                'data' => $pegawai
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];
            return response()->json($data, 404);
        }
    }

    // Fungsi untuk mencari status aktif
    public function active($status)
    {
        $pegawai = Pegawai::where($status, 'aktif')->get();
        $total = $pegawai->count();
        $data = [
            'message' => 'Get Active Resource',
            'total' => $total,
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }

    // Fungsi untuk mencari status tidak aktif
    public function inactive($status)
    {
        $pegawai = Pegawai::where($status, 'tidak aktif')->get();
        $total = $pegawai->count();
        $data = [
            'message' => 'Get Active Resource',
            'total' => $total,
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }

    // Fungsi untuk mencari status tidak aktif
    public function terminated($status)
    {
        $pegawai = Pegawai::where($status, 'dihentikan')->get();
        $total = $pegawai->count();
        $data = [
            'message' => 'Get Terminated Resource',
            'total' => $total,
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }
}
