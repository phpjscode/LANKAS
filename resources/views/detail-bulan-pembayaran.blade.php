<x-layout :title="$title">
    @section('page')
        <main class="bg-slate-100 h-screen pt-20 p-4 sm:ml-64 font-poppins">
            <div class="relative overflow-x-auto">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="">
                            <h1 class="text-2xl">{{ $title }}</h1>
                            <h2 class="text-xl">Rp{{ number_format($pembayaranPerminggu, 0, ',', '.') }} / minggu</h2>
                        </div>
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

                                        {{-- Cek apakah minggu ke-1 memenuhi pembayaran per minggu --}}
                                        @php $isMingguPertamaLengkap = $kas->minggu_ke_1 >= $pembayaranPerminggu; @endphp

                                        @for ($i = 1; $i <= 4; $i++)
                                            <td class="px-6 py-4">
                                                <button
                                                    class="text-xs p-1 rounded 
                                                    {{ !$isMingguPertamaLengkap && $i > 1 ? 'bg-gray-400 text-gray-700 cursor-not-allowed' : 'bg-red-600 text-white' }}"
                                                    onclick="openEditModal({{ $kas->id_siswa }}, 'minggu_ke_{{ $i }}', {{ $kas->{'minggu_ke_' . $i} }})"
                                                    {{ !$isMingguPertamaLengkap && $i > 1 ? 'disabled' : '' }}>

                                                    {{-- Tampilkan nilai atau kosongkan jika disabled --}}
                                                    {{ !$isMingguPertamaLengkap && $i > 1 ? '<---' : number_format($kas->{'minggu_ke_' . $i}, 0, ',', '.') }}
                                                </button>
                                            </td>
                                        @endfor
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

            <!-- Modal Edit -->
            <div id="editModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Edit Pembayaran</h2>
                    <form id="editForm">
                        <input type="hidden" id="id_siswa" name="id_siswa">
                        <input type="hidden" id="minggu_ke" name="minggu_ke">
                        <div class="mb-4">
                            <label for="nilai" class="block text-gray-700">Jumlah Bayar</label>
                            <input type="number" id="nilai" name="nilai" class="w-full p-2 border rounded"
                                max="{{ $pembayaranPerminggu }}" required>
                            <small class="text-gray-500">Nilai maksimal:
                                Rp{{ number_format($pembayaranPerminggu, 0, ',', '.') }}</small>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" id="closeModal"
                                class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>


            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function openEditModal(id_siswa, minggu_ke, nilai) {
                    $('#id_siswa').val(id_siswa);
                    $('#minggu_ke').val(minggu_ke);
                    $('#nilai').val(nilai);
                    $('#editModal').removeClass('hidden').addClass('flex');
                }

                $('#closeModal').on('click', function() {
                    $('#editModal').addClass('hidden').removeClass('flex');
                });

                $('#editForm').on('submit', function(e) {
                    e.preventDefault();

                    let id_siswa = $('#id_siswa').val();
                    let minggu_ke = $('#minggu_ke').val();
                    let nilai = $('#nilai').val();
                    let maxNilai = {{ $pembayaranPerminggu }}; // Pastikan ini diambil dari blade

                    if (nilai > maxNilai) {
                        alert('Nilai tidak boleh melebihi ' + maxNilai);
                        return;
                    }

                    $.ajax({
                        url: '{{ route('detailbulanpembayaran.update') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id_siswa: id_siswa,
                            minggu_ke: minggu_ke,
                            nilai: nilai,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Data berhasil diupdate');
                                location.reload();
                            } else {
                                alert('Gagal mengupdate data');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui data');
                        }
                    });
                });
            </script>
        </main>
    @endsection
</x-layout>
