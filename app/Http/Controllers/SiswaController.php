<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function showSiswa(Request $request)
    {
        $jumlah = $request->input('jumlah', 5);
        $siswa = Siswa::paginate($jumlah);

        if ($request->ajax()) {
            return view('components.table-siswa', compact('siswa'))->render();
        }

        return view('siswa', [
            'siswa' => $siswa,
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

    public function destroySiswa($id)
    {
        $siswa = Siswa::findOrFail($id); // Temukan siswa berdasarkan ID
        $siswa->delete(); // Hapus siswa

        return response()->json(['message' => 'Siswa berhasil dihapus.']);
    }

    public function storeSiswa(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telepon' => 'required|string|max:15',
        ]);

        Siswa::create($validated); // Simpan data siswa baru

        return response()->json(['message' => 'Siswa berhasil ditambahkan.']);
    }

    public function filterSiswa(Request $request)
    {
        $query = Siswa::query();

        if ($request->has('search') && $request->search !== '') {
            $query->where('nama_siswa', 'like', '%' . $request->search . '%')
                ->orWhere('jenis_kelamin', 'like', '%' . $request->search . '%')
                ->orWhere('no_telepon', 'like', '%' . $request->search . '%');
        }

        $siswa = $query->get();

        if ($request->ajax()) {
            return view('components.table-siswa', compact('siswa'))->render();
        }

        return view('siswa', [
            'siswa' => $siswa,
            'title' => 'Siswa'
        ]);
    }
}
