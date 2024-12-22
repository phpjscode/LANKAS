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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-6 h-6"
                                        fill="#ffffff">
                                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                    </svg>
                                </div>
                                <span>Tambah Siswa</span>
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
                                <label for="search" class="text-sm font-medium text-gray-700">Cari:</label>
                                <input type="text" id="search" name="search" class="p-1 text-sm border rounded w-40"
                                    placeholder="data siswa...">
                            </div>
                        </div>
                    </div>

                    <x-table-siswa :siswa="$siswa"></x-table-siswa>
                </div>
            </main>
        @endsection
    </x-layout>
