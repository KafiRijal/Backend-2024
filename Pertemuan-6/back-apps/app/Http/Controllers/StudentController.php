<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // Fungsi untuk menampilkan semua data
    public function index()
    {
        // Melihat Data
        // Query Builder, student = DB::table('student')->get();
        $student = Student::all(); // Menggunakan Eloquent
        if ($student) {
            $data = [
                'message' => 'Berhasil akses data',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data tidak ada'
            ];
            return response()->json($data, 404);
        }
    }

    // Fungsi untuk menyimpan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }
        $student = Student::create($request->all());
        $data = [
            'message' => 'Berhasil menambah data',
            'data' => $student
        ];
        return response()->json($data, 201);
    }

    // Fungsi untuk mengubah data berdasarkan id
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->nama = $request->nama ?? $student->nama;
            $student->nim = $request->nim ?? $student->nim;
            $student->email = $request->email ?? $student->email;
            $student->jurusan = $request->jurusan ?? $student->jurusan;
            $student->save();
            $data = [
                'message' => 'Berhasil mengubah data',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data tidak ditemukan'
            ];
            return response()->json($data, 404);
        }
    }

    // Fungsi untuk menghapus data berdasarkan id
    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            $data = [
                'message' => 'Berhasil menghapus data',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data tidak ditemukan'
            ];
            return response()->json($data, 404);
        }
    }
    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            $data = [
                'message' => 'Get detail data',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Get detail data gagal'
            ];
            return response()->json($data, 404);
        }
    }
}
