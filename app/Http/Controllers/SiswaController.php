<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function showSiswa()
    {
        return view('siswa', [
            'siswa' => Siswa::all(),
            'title' => 'Siswa'
        ]);
    }

    public function updateSiswa(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telepon' => 'required|string|max:15',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->only('nama_siswa', 'jenis_kelamin', 'no_telepon'));

        return response()->json(['message' => 'Data siswa berhasil diperbarui.']);
    }
}
