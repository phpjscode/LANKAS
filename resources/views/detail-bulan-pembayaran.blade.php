<x-layout :title="$title">
    @section('page')
        <main class="bg-slate-100 h-screen pt-20 p-4 sm:ml-64 font-poppins">
            <div class="relative overflow-x-auto">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl">{{ $title }}</h1>
                        <a href="{{ route('siswa') }}"
                            class=" flex items-center justify-center space-x-1 px-4 py-2 rounded bg-blue-500 text-white">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6"
                                    fill="#ffffff">
                                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                </svg>
                            </div>
                            <span>Tambah Siswa</span>
                        </a>
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
                                placeholder="Cari siswa...">
                        </div>
                    </div>
                </div>


                <!-- Table -->
                <div class="flex flex-col mt-4">
                    <div class="overflow-auto max-h-[calc(100vh-15rem)] border rounded">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Nama Siswa</th>
                                    <th class="px-6 py-3">Minggu Ke-1</th>
                                    <th class="px-6 py-3">Minggu Ke-2</th>
                                    <th class="px-6 py-3">Minggu Ke-3</th>
                                    <th class="px-6 py-3">Minggu Ke-4</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bulan->uangKas as $index => $kas)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4">{{ $kas->siswa->nama_siswa }}</td>
                                        <td class="px-6 py-4">Rp{{ number_format($kas->minggu_ke_1, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">Rp{{ number_format($kas->minggu_ke_2, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">Rp{{ number_format($kas->minggu_ke_3, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">Rp{{ number_format($kas->minggu_ke_4, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center">Data siswa tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    @endsection
</x-layout>
