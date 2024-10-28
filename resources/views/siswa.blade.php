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
                            <th class="px-6 py-3 flex items-center justify-center">Aksi</th>
                        </tr>
                    </thead>
                    <!-- Table -->
                    <tbody>
                        @forelse ($siswa as $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">{{ $item->nama_siswa }}</td>
                                <td class="px-6 py-4">{{ $item->jenis_kelamin }}</td>
                                <td class="px-6 py-4">{{ $item->no_telepon }}</td>
                                <td class="px-6 py-4 flex items-center justify-center">
                                    <button class="text-blue-500 hover:underline edit-btn" data-id="{{ $item->id }}"
                                        data-nama="{{ $item->nama_siswa }}" data-jenis="{{ $item->jenis_kelamin }}"
                                        data-telepon="{{ $item->no_telepon }}">
                                        Ubah
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Data siswa tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    <!-- Modal -->
                    <div id="editModal"
                        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-1/3">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl mb-4">Edit Siswa</h2>
                                <button type="button"
                                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    onclick="closeModal()">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                            </div>
                            </button>
                            <form id="editForm">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" id="siswaId" name="id">

                                <div class="mb-4">
                                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama
                                        Siswa</label>
                                    <input type="text" id="nama_siswa" name="nama_siswa"
                                        class="mt-1 p-2 border rounded w-full" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <div class="flex gap-4">
                                        <label>
                                            <input type="radio" name="jenis_kelamin" value="Laki-laki" id="jkLaki">
                                            Laki-laki
                                        </label>
                                        <label>
                                            <input type="radio" name="jenis_kelamin" value="Perempuan" id="jkPerempuan">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="no_telepon" class="block text-sm font-medium text-gray-700">No.
                                        Telepon</label>
                                    <input type="text" id="no_telepon" name="no_telepon"
                                        class="mt-1 p-2 border rounded w-full" required>
                                </div>

                                <div class="flex justify-end">
                                    <button type="button" class="mr-2 bg-gray-500 text-white px-4 py-2 rounded"
                                        onclick="closeModal()">Batal</button>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </table>
            </div>
        </main>

        <script>
            $(document).ready(function() {
                // Saat tombol edit diklik
                $('.edit-btn').on('click', function() {
                    let id = $(this).data('id');
                    let nama = $(this).data('nama');
                    let jenis = $(this).data('jenis');
                    let telepon = $(this).data('telepon');

                    // Set value input modal
                    $('#siswaId').val(id);
                    $('#nama_siswa').val(nama);
                    $('#no_telepon').val(telepon);

                    // Set radio button sesuai jenis kelamin
                    if (jenis === 'Laki-laki') {
                        $('#jkLaki').prop('checked', true);
                    } else {
                        $('#jkPerempuan').prop('checked', true);
                    }

                    // Tampilkan modal
                    $('#editModal').removeClass('hidden').addClass('flex');
                });

                // Submit form dengan AJAX
                $('#editForm').on('submit', function(e) {
                    e.preventDefault();
                    let id = $('#siswaId').val();
                    let formData = $(this).serialize();

                    $.ajax({
                        url: `/siswa/${id}`,
                        type: 'PATCH',
                        data: formData,
                        success: function(response) {
                            alert('Data berhasil diperbarui!');
                            location.reload(); // Reload halaman untuk melihat perubahan
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    });
                });
            });

            // Fungsi untuk menutup modal
            function closeModal() {
                $('#editModal').addClass('hidden').removeClass('flex');
            }
        </script>
    @endsection
</x-layout>
