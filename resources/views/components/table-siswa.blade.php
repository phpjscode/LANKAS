<div class="flex flex-col mt-4">
    <div class="overflow-auto max-h-[calc(100vh-15rem)] border rounded">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Siswa</th>
                    <th class="px-6 py-3">Jenis Kelamin</th>
                    <th class="px-6 py-3">No. Telepon</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswa as $item)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $item->nama_siswa }}</td>
                        <td class="px-6 py-4">{{ $item->jenis_kelamin }}</td>
                        <td class="px-6 py-4">{{ $item->no_telepon }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <button class="text-blue-500 hover:underline edit-btn" data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama_siswa }}" data-jenis="{{ $item->jenis_kelamin }}"
                                data-telepon="{{ $item->no_telepon }}">Ubah</button>
                            <button class="text-red-500 hover:underline hapus-btn"
                                data-id="{{ $item->id }}">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">Data siswa tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
