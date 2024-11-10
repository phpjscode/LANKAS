<div class="flex flex-col mt-4">
    <div class="overflow-auto max-h-[calc(100vh-15rem)] border rounded"> <!-- Adjust the max height as needed -->
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

<script>
    $(document).ready(function() {
        // Setup CSRF Token agar setiap request AJAX aman
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Tutup modal saat tombol batal atau close diklik
        $(document).on('click', '.close-modal-btn', closeModal);

        // Fungsi untuk menutup modal
        function closeModal() {
            $('#editModal, #tambahModal').addClass('hidden').removeClass('flex');
            $('#editForm')[0].reset(); // Reset form edit siswa
            $('#tambahForm')[0].reset(); // Reset form tambah siswa
        }

        // Event delegation untuk menampilkan modal edit siswa
        $(document).on('click', '.edit-btn', function() {
            let {
                id,
                nama,
                jenis,
                telepon
            } = $(this).data();

            // Isi form dengan data siswa yang dipilih
            $('#siswaId').val(id);
            $('#nama_siswa').val(nama);
            $('#no_telepon').val(telepon);

            // Set radio button berdasarkan jenis kelamin
            if (jenis === 'Laki-laki') {
                $('.jkLaki').prop('checked', true);
            } else {
                $('.jkPerempuan').prop('checked', true);
            }

            // Tampilkan modal edit
            $('#editModal').removeClass('hidden').addClass('flex');
        });

        // Submit form edit siswa menggunakan AJAX
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#siswaId').val();
            let formData = $(this).serialize();

            $.ajax({
                url: `/siswa/${id}`,
                type: 'PATCH',
                data: formData,
                success: function() {
                    alert('Data berhasil diperbarui!');
                    location.reload();
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });

        // Event delegation untuk menghapus siswa
        $(document).on('click', '.hapus-btn', function() {
            let id = $(this).data('id');

            if (confirm('Apakah Anda yakin ingin menghapus siswa ini?')) {
                $.ajax({
                    url: `/siswa/${id}`,
                    type: 'DELETE',
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Siswa tidak dapat dihapus.');
                    }
                });
            }
        });

        // Tampilkan modal tambah siswa saat tombol tambah diklik
        $(document).on('click', '.tambah-btn', function() {
            $('#tambahModal').removeClass('hidden').addClass('flex');
        });

        // Submit form tambah siswa menggunakan AJAX
        $('#tambahForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('siswa.store') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    closeModal();
                    location.reload();
                },
                error: function() {
                    alert('Terjadi kesalahan. Gagal menambah siswa.');
                }
            });
        });

        // Filter jumlah data siswa yang ditampilkan berdasarkan pilihan "entries"
        $('#jumlah').on('change', function() {
            let jumlah = $(this).val();

            $.ajax({
                url: "{{ route('siswa') }}",
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
                url: "{{ route('siswa.filter') }}",
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
