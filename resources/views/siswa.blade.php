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
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                
                                <!-- Nama Siswa -->
                                <td class="px-6 py-4" x-data="{ editing: false, value: '{{ $item->nama_siswa }}' }">
                                    <div x-show="!editing" @click="editing = true" class="cursor-pointer">
                                        <span x-text="value"></span>
                                    </div>
                                    <input 
                                        x-show="editing" 
                                        type="text" 
                                        x-model="value" 
                                        @keydown.enter="update('{{ route('siswa.update', $item->id) }}', { nama_siswa: value })" 
                                        @click.away="editing = false" 
                                        class="border px-2 py-1 w-full">
                                </td>
                
                                <!-- Jenis Kelamin -->
                                <td class="px-6 py-4" x-data="{ editing: false, value: '{{ $item->jenis_kelamin }}' }">
                                    <div x-show="!editing" @click="editing = true" class="cursor-pointer">
                                        <span x-text="value"></span>
                                    </div>
                                    <select 
                                        x-show="editing" 
                                        x-model="value" 
                                        @change="update('{{ route('siswa.update', $item->id) }}', { jenis_kelamin: value })"
                                        @click.away="editing = false"
                                        class="border px-2 py-1 w-full">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </td>
                
                                <!-- No. Telepon -->
                                <td class="px-6 py-4" x-data="{ editing: false, value: '{{ $item->no_telepon }}' }">
                                    <div x-show="!editing" @click="editing = true" class="cursor-pointer">
                                        <span x-text="value"></span>
                                    </div>
                                    <input 
                                        x-show="editing" 
                                        type="text" 
                                        x-model="value" 
                                        @keydown.enter="update('{{ route('siswa.update', $item->id) }}', { no_telepon: value })" 
                                        @click.away="editing = false" 
                                        class="border px-2 py-1 w-full">
                                </td>
                
                                <td class="px-6 py-4">
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
                
                <script>
                    function update(url, data) {
                        fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal memperbarui data!');
                            }
                            return response.json();
                        })
                        .then(result => {
                            alert('Data berhasil diperbarui!');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui data.');
                        });
                    }
                </script>                
            </div>
        </main>
    @endsection
</x-layout>
