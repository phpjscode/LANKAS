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


<!-- Modal Ubah Siswa -->
<div id="editModal" class="editModal hidden fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-1/3">
        <div class="flex items-center justify-between">
            <h2 class="text-xl mb-4">Edit Siswa</h2>
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
        <form id="editForm">
            @csrf
            @method('PATCH')
            <input type="hidden" id="siswaId" name="id">

            <div class="mb-4">
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" class="mt-1 p-2 border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <div class="flex gap-4">
                    <label>
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" class="jkLaki" required>
                        Laki-laki
                    </label>
                    <label>
                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="jkPerempuan">
                        Perempuan
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" class="mt-1 p-2 border rounded w-full" required>
            </div>

            <div class="flex justify-end">
                <button type="button"
                    class="mr-2 bg-gray-500 text-white px-4 py-2 rounded close-modal-btn">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Form Tambah Siswa -->
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
                <input type="text" id="nama_siswa" name="nama_siswa" class="mt-1 p-2 border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <div class="flex gap-4">
                    <label>
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" required>
                        Laki-laki
                    </label>
                    <label>
                        <input type="radio" name="jenis_kelamin" value="Perempuan" required>
                        Perempuan
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input type="tel" id="no_telepon" name="no_telepon" class="mt-1 p-2 border rounded w-full"
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
