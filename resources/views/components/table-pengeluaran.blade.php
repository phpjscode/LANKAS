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
                @forelse($pengeluaran as $index => $item)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $item->user->name ?? 'User Tidak Ditemukan' }}</td>
                        <td class="px-6 py-4">{{ $item->keterangan }}</td>
                        <td class="px-6 py-4">{{ $item->tanggal_pengeluaran }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($item->jumlah_pengeluaran, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <button class="text-blue-500 hover:underline edit-btn" data-id="{{ $item->id }}"
                                data-jumlah_pengeluaran="{{ $item->jumlah_pengeluaran }}"
                                data-keterangan="{{ $item->keterangan }}">
                                Ubah
                            </button>
                            <button class="text-red-500 hover:underline hapus-btn"
                                data-id="{{ $item->id }}">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">Data pengeluaran tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#jumlah').on('change', function() {
            let jumlah = $(this).val();

            $.ajax({
                url: "{{ route('pengeluaran') }}",
                type: 'GET',
                data: {
                    jumlah
                },
                success: function(response) {
                    $('tbody').html($(response).find('tbody').html()); // Update tbody
                },
                error: function() {
                    alert('Terjadi kesalahan. Data tidak dapat dimuat.');
                }
            });
        });

        // Pencarian siswa secara real-time berdasarkan input
        $('#search').on('keyup', function() {
            let search = $(this).val();

            $.ajax({
                url: "{{ route('pengeluaran.filter') }}",
                type: 'GET',
                data: {
                    search
                },
                success: function(response) {
                    $('tbody').html($(response).find('tbody').html()); // Update tbody
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });
        });
    });
</script>
