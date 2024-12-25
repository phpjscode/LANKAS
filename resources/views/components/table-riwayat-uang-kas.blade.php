<div class="flex flex-col mt-4">
    <div class="overflow-auto max-h-[calc(100vh-15rem)] border rounded">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Keterangan</th>
                    <th class="px-6 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayatUangKas as $index => $item)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $item->user->name ?? 'User Tidak Ditemukan' }}</td>
                        <td class="px-6 py-4">{{ $item->aksi }}</td>
                        <td class="px-6 py-4">{{ $item->tanggal }}</td>
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
                url: "{{ route('riwayatuangkas') }}",
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
                url: "{{ route('riwayatuangkas.filter') }}",
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
