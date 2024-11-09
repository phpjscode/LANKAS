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
        @forelse($uangKas as $index => $kas)
            <tr class="bg-white border-b">
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">{{ $kas->siswa->nama_siswa }}</td>

                @php
                    $isMingguTerbuka = true;
                @endphp

                @for ($i = 1; $i <= 4; $i++)
                    @php
                        $isMingguIniLengkap = $kas->{'minggu_ke_' . $i} >= $pembayaranPerminggu;
                    @endphp

                    <td class="px-6 py-4">
                        <button
                            class="text-xs p-1 rounded 
                          {{ $isMingguIniLengkap
                              ? 'bg-green-600 text-white'
                              : (!$isMingguTerbuka
                                  ? 'bg-gray-400 text-gray-700 cursor-not-allowed'
                                  : 'bg-red-600 text-white') }}"
                            onclick="openEditModal({{ $kas->id_siswa }}, 'minggu_ke_{{ $i }}', {{ $kas->{'minggu_ke_' . $i} }})"
                            {{ !$isMingguTerbuka ? 'disabled' : '' }}>
                            {{ !$isMingguTerbuka ? '<---' : number_format($kas->{'minggu_ke_' . $i}, 0, ',', '.') }}
                        </button>
                    </td>

                    @php
                        $isMingguTerbuka = $isMingguIniLengkap;
                    @endphp
                @endfor
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center">Data siswa tidak ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>
