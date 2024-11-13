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
        // Fungsi untuk menampilkan semua data pegawai
        // Mengambil seluruh data pegawai dari database dan mengembalikannya dalam format JSON
        // Jika berhasil, akan menampilkan pesan "Get All Resource"
        // Jika gagal, akan menampilkan pesan "Data is empty"
        $pegawai = Pegawai::all();
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

    // Fungsi untuk menyimpan data pegawai baru
    // Memvalidasi inputan sebelum disimpan ke database
    // Jika berhasil, akan menampilkan pesan "Resource is added successfully"
    // Jika gagal, akan menampilkan pesan "Validation errors"
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'email' => 'email|required',
            'status' => 'required',
            'hired_on' => 'required',
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

    // Fungsi untuk menampilkan detail data pegawai berdasarkan id
    // Mengambil data pegawai dari database menggunakan id yang diminta
    // Jika berhasil, akan menampilkan pesan "Get Detail Resource"
    // Jika gagal, akan menampilkan pesan "Resource not found"
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

    // Fungsi untuk memperbarui data pegawai berdasarkan id
    // Mengambil data pegawai berdasarkan id dan memperbarui atributnya
    // Jika berhasil, akan menampilkan pesan "Resource is updated successfully"
    // Jika gagal, akan menampilkan pesan "Resource not found"
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
            $pegawai->hired_on = $request->hired_on ?? $pegawai->hired_on;
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

    // Fungsi untuk menghapus data pegawai berdasarkan id
    // Menghapus data pegawai dari database berdasarkan id
    // Jika berhasil, akan menampilkan pesan "Resource is delete successfully"
    // Jika gagal, akan menampilkan pesan "Resource not found"
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

    // Fungsi untuk mencari data pegawai berdasarkan nama
    // Mencari pegawai berdasarkan nama yang diberikan dan mengembalikan data yang sesuai dengan nama yang diberikaan
    // Jika berhasil, akan menampilkan pesan "Get Searched Resource"
    // Jika gagal, akan menampilkan pesan "Resource not found"
    // Untuk nama yang diberikan, bisa menggunakan nama sebagai key di dalam array
    public function search($name)
    {
        $pegawai = Pegawai::where('name', 'like', '%' . $name . '%')->get();
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

    // Fungsi untuk mendapatkan semua data pegawai dengan status aktif
    // Mengambil data pegawai yang memiliki status aktif dan menghitung totalnya
    public function active()
    {
        $pegawai = Pegawai::where('status', 'active')->get();
        $total = $pegawai->count();
        $data = [
            'message' => 'Get Active Resource',
            'total' => $total,
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }

    // Fungsi untuk mendapatkan semua data pegawai dengan status tidak aktif
    // Mengambil data pegawai yang memiliki status tidak aktif dan menghitung totalnya
    public function inactive()
    {
        $pegawai = Pegawai::where('status', 'inactive')->get();
        $total = $pegawai->count();
        $data = [
            'message' => 'Get Active Resource',
            'total' => $total,
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }

    // Fungsi untuk mendapatkan semua data pegawai dengan status dihentikan
    // Mengambil data pegawai yang memiliki status dihentikan dan menghitung totalnya
    public function terminated()
    {
        $pegawai = Pegawai::where('status', 'terminated')->get();
        $total = $pegawai->count();
        $data = [
            'message' => 'Get Terminated Resource',
            'total' => $total,
            'data' => $pegawai
        ];
        return response()->json($data, 200);
    }
}
