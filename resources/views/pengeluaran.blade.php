<x-layout :title="$title">
    @section('page')
        <main class="bg-slate-100 h-screen pt-20 p-4 sm:ml-64 font-poppins">
            <div class="relative overflow-x-auto">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl">{{ $title }}</h1>
                        <button
                            class="tambah-btn flex items-center justify-center space-x-1 px-4 py-2 rounded bg-blue-500 text-white">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6" fill="#ffffff">
                                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                </svg>
                            </div>
                            <span>Tambah Pengeluaran</span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center justify-start space-x-2 mb-4">
                            <label for="jumlah" class="text-sm font-medium text-gray-700">Show</label>
                            <select id="jumlah" name="jumlah" class="p-1 text-sm border rounded">
                                <option value="5" {{ request('jumlah') == 5 ? 'selected' : '' }}>5</option>
                                <option value="20" {{ request('jumlah') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ request('jumlah') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                            <p class="text-sm">entries</p>
                        </div>
                        <div class="flex items-center space-x-2 mb-4">
                            <label for="search" class="text-sm font-medium text-gray-700">Search:</label>
                            <input type="text" id="search" name="search" class="p-1 text-sm border rounded w-40"
                                placeholder="Cari pengeluaran...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <div class="overflow-auto max-h-[calc(100vh-15rem)] border rounded">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Keterangan</th>
                                <th class="px-6 py-3">Tanggal Pengeluaran</th>
                                <th class="px-6 py-3">Jumlah Pengeluaran</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <button class="text-blue-500 hover:underline">Ubah</button>
                                    <button class="text-red-500 hover:underline">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Data pengeluaran tidak ditemukan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tambahModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md sm:w-1/3">
                    <div class="flex items-center justify-between pb-5">
                        <h3 class="text-xl text-gray-900">Tambah Siswa</h3>
                        <button type="button"
                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center close-modal-btn">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form id="tambahForm">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                            <input type="number" id="nama_siswa" name="nama_siswa" class="mt-1 p-2 border rounded w-full"
                                required>
                        </div>

                        <div class="flex justify-end">
                            <button type="button"
                                class="mr-2 bg-gray-500 text-white px-4 py-2 rounded close-modal-btn">Batal</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // Menampilkan modal tambah pengeluaran
                    $(document).on('click', '.tambah-btn', function() {
                        $('#tambahModal').removeClass('hidden').addClass('flex');
                    });

                    // Menutup modal saat tombol batal atau close diklik
                    $(document).on('click', '.close-modal-btn', closeModal);

                    // Fungsi yang digunakan untuk menutup modal
                    function closeModal() {
                        $('#editModal, #tambahModal').addClass('hidden').removeClass('flex');
                        $('#editForm')[0].reset(); // Reset form edit siswa
                        $('#tambahForm')[0].reset(); // Reset form tambah siswa
                    }
                });
            </script>
        </main>
    @endsection
</x-layout>
