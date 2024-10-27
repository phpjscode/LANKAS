<x-layout :title="$title">
    @section('page')
        <main class="bg-slate-100 pt-20 p-4 sm:ml-64">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Siswa</th>
                            <th class="px-6 py-3">Jenis Kelamin</th>
                            <th class="px-6 py-3">No. Telepon</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $index => $item)
                            <tr class="bg-white border-b"">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">{{ $item->nama_siswa }}</td>
                                <td class="px-6 py-4">{{ $item->jenis_kelamin }}</td>
                                <td class="px-6 py-4">{{ $item->no_telepon }}</td>
                                <td class="px-6 py-4">
                                    <button class="btn-ubah text-blue-500 hover:underline">Ubah</button>
                                    <button class="text-red-500 hover:underline">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Data siswa tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    @endsection
</x-layout>
