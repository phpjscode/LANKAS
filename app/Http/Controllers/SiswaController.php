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
    $validatedData = $request->validate([
        'nama_siswa' => 'nullable|string|max:255',
        'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        'no_telepon' => 'nullable|string|max:15',
    ]);

    $siswa = Siswa::findOrFail($id);
    $siswa->update($validatedData);

    return response()->json(['message' => 'Data berhasil diperbarui!']);
}

}
