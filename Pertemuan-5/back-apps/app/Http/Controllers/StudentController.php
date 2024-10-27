<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Fungsi untuk menampilkan semua data
    public function index()
    {
        // Melihat Data
        // Query Builder, student = DB::table('student')->get();
        $student = Student::all(); // Menggunakan Eloquent
        $data = [
            'message' => 'Berhasil akses data',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    // Fungsi untuk menyimpan data baru
    public function store(Request $request)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];
        $student = Student::create($input);
        $data = [
            'message' => 'Berhasil menambah data',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    // Fungsi untuk mengubah data berdasarkan id
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->nama = $request->nama;
            $student->nim = $request->nim;
            $student->email = $request->email;
            $student->jurusan = $request->jurusan;
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
}
